// Restaurant Menu Start

function fn() {
	const sectionsContainer = document.querySelector('.page-sections')
	const sections = document.querySelectorAll('.page-section')
	const nav = document.querySelector('.nav-sections')
	if (nav) {
		const menu = nav.querySelector('.menu')
		const links = nav.querySelectorAll('.menu-item-link')
		const activeLine = nav.querySelector('.active-line')
		const sectionOffset = nav.offsetHeight + 24 // Nav height offset

		const activeClass = 'active'
		let activeIndex = 0
		let isScrolling = true
		let userScroll = true

		const setActiveClass = () => {
			if (activeIndex >= 0 && activeIndex < links.length) {
				links[activeIndex].classList.add(activeClass)
			}
		}

		const removeActiveClass = () => {
			if (activeIndex >= 0 && activeIndex < links.length) {
				links[activeIndex].classList.remove(activeClass)
			}
		}

		setActiveClass()

		const moveActiveLine = () => {
			// Ensure activeIndex is within bounds
			if (activeIndex < 0 || activeIndex >= links.length) {
				return
			}
			const link = links[activeIndex]
			if (!link) {
				return
			}
			// Get bounding rectangle values
			const linkRect = link.getBoundingClientRect()
			const menuRect = menu.getBoundingClientRect()

			activeLine.style.transform = `translateX(${
				menu.scrollLeft - menuRect.x + linkRect.x
			}px)`
			activeLine.style.width = `${link.offsetWidth}px`
		}
		// Set menu scroll position
		const setMenuLeftPosition = (position) => {
			menu.scrollTo({
				left: position,
				behavior: 'smooth',
			})
		}
		const checkMenuOverflow = () => {
			// Check that activeIndex is within the bounds of links
			if (activeIndex < 0 || activeIndex >= links.length) {
				return
			}

			const activeLink = links[activeIndex].getBoundingClientRect()
			const offset = 30

			if (Math.floor(activeLink.right) > window.innerWidth) {
				setMenuLeftPosition(
					menu.scrollLeft + activeLink.right - window.innerWidth + offset
				)
			} else if (activeLink.left < 0) {
				setMenuLeftPosition(menu.scrollLeft + activeLink.left - offset)
			}
		}

		// Update active link and scroll positions
		const handleActiveLinkUpdate = (current) => {
			removeActiveClass()
			activeIndex = current
			checkMenuOverflow()
			setActiveClass()
			moveActiveLine()
		}

		const init = () => {
			moveActiveLine(links[0])
			document.documentElement.style.setProperty(
				'--section-offset',
				sectionOffset
			)
		}
		init()

		// Add click event for scrolling to section with offset
		links.forEach((link, index) => {
			link.addEventListener('click', (e) => {
				e.preventDefault() // Prevent default anchor behavior
				userScroll = false
				handleActiveLinkUpdate(index)
				// Scroll to section with cross-browser compatibility
				const sectionTop =
					sections[index].getBoundingClientRect().top + window.pageYOffset
				window.scrollTo({
					top: sectionTop - sectionOffset, // Adjust for nav height
					behavior: 'smooth',
				})
			})
		})

		// Listen for window scroll to adjust active link based on section in view
		window.addEventListener('scroll', () => {
			const currentIndex =
				sectionsContainer.getBoundingClientRect().top < 0
					? sections.length -
					  1 -
					  [...sections]
							.reverse()
							.findIndex(
								(section) =>
									window.pageYOffset >=
									section.getBoundingClientRect().top +
										window.pageYOffset -
										sectionOffset * 2
							)
					: 0

			if (userScroll && activeIndex !== currentIndex) {
				handleActiveLinkUpdate(currentIndex)
			} else {
				window.clearTimeout(isScrolling)
				isScrolling = setTimeout(() => (userScroll = true), 100)
			}
		})
	}
}

window.addEventListener('DOMContentLoaded', fn, false)
