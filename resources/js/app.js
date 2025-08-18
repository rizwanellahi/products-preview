document.addEventListener('DOMContentLoaded', function () {
	MicroModal.init({
		disableScroll: true, // Prevent page scroll when modal is open
		awaitCloseAnimation: true, // Wait for the close animation
	})

	// Select all links inside the modal that should trigger a scroll to a section
	const categoryLinks = document.querySelectorAll('.category-item a') // Adjust selector as necessary

	categoryLinks.forEach((link) => {
		link.addEventListener('click', function (event) {
			// Prevent default anchor behavior
			event.preventDefault()

			// Get the target section from the href attribute (e.g. #section-id)
			const targetSectionId = this.getAttribute('href')

			// Close the modal first
			MicroModal.close('menu-cat')

			// Delay to ensure the modal is closed before changing the URL and scrolling
			setTimeout(function () {
				if (targetSectionId) {
					// Change the URL hash to navigate to the section
					window.location.hash = targetSectionId

					// Manually trigger scroll in case the browser doesn't auto-scroll
					const targetElement = document.querySelector(targetSectionId)
					if (targetElement) {
						targetElement.scrollIntoView({
							behavior: 'smooth',
							block: 'start',
						})
					}
				}
			}, 200) // Adjust delay if necessary
		})
	})

	var shareBtnx = document.getElementById('share-btn-x')
	shareBtnx.addEventListener('click', function (event) {
		event.preventDefault() // Prevent default anchor click behavior
		// Retrieve the current page URL
		const currentUrl = window.location.href
		if (navigator.share) {
			navigator
				.share({
					title: 'Digital Menu - Designed by logix360.studio',
					text: 'Digital Menu:',
					url: currentUrl, // Share the current page URL
				})
				.then(() => console.log('Share successful'))
				.catch((error) => console.error('Error sharing:', error))
		} else {
			// Fallback for browsers that do not support the share API
			alert(
				'Sharing is not supported in this browser. Please copy the link: ' +
					currentUrl
			)
		}
	})

	var shareBtnHeader = document.getElementById('share-btn-header')
	shareBtnHeader.addEventListener('click', function (event) {
		event.preventDefault() // Prevent default anchor click behavior
		// Retrieve the current page URL
		const currentUrl = window.location.href
		if (navigator.share) {
			navigator
				.share({
					title: 'Digital Menu - Designed by logix360.studio',
					text: 'Digital Menu:',
					url: currentUrl, // Share the current page URL
				})
				.then(() => console.log('Share successful'))
				.catch((error) => console.error('Error sharing:', error))
		} else {
			// Fallback for browsers that do not support the share API
			alert(
				'Sharing is not supported in this browser. Please copy the link: ' +
					currentUrl
			)
		}
	})
	var qrCodeImg = document.querySelector('#qr-code img')
	var downloadBtn = document.getElementById('download-btn')

	// Check if qrCodeImg, downloadBtn exist
	if (qrCodeImg && downloadBtn) {
		// Listen for the QR code image to load fully
		qrCodeImg.addEventListener('load', function () {
			var qrCodeSrc =
				qrCodeImg.getAttribute('src') || qrCodeImg.getAttribute('data-src')
			// Assign the correct src to the download button
			if (qrCodeSrc) {
				downloadBtn.href = qrCodeSrc
			}
		})

		// Fallback in case the image is already loaded
		if (qrCodeImg.complete) {
			var qrCodeSrc =
				qrCodeImg.getAttribute('src') || qrCodeImg.getAttribute('data-src')
			// console.log('Complete QR code source:', qrCodeSrc)

			// Assign the correct src to the download button
			if (qrCodeSrc) {
				downloadBtn.href = qrCodeSrc
			}
		}
	}
})

// window.addEventListener('scroll', function () {
// 	const parallaxBackground = document.querySelector('.restaurant-details')
// 	let scrollPosition = window.scrollY
// 	// Adjust the transform to create the parallax effect
// 	parallaxBackground.style.transform =
// 		'translateY(' + scrollPosition * 0.5 + 'px)'
// })

// Tabs
document.addEventListener('DOMContentLoaded', function () {
	const selectEl = document.getElementById('tabs-select')
	const tabLinks = document.querySelectorAll('#tabs-nav a')
	const tabContents = document.querySelectorAll('[data-tab-content]')

	// Helper: Get the text label or data-tab-target to identify which content to show
	function getTabIdentifier(anchor) {
		// Option 1: Use the data-tab-target attribute if present
		const dataTarget = anchor.getAttribute('data-tab-target')
		if (dataTarget) return dataTarget

		// Option 2: Fallback to text content if needed
		return anchor
			.querySelector('span')
			?.textContent.trim()
			.toLowerCase()
			.replace(/\s+/g, '-')
	}

	// Show/hide appropriate content
	function showTabContent(tabId) {
		// Hide all content
		tabContents.forEach((content) => {
			content.classList.add('hidden')
		})

		// Show the matching content
		const activeContent = document.querySelector(
			`[data-tab-content="${tabId}"]`
		)
		if (activeContent) {
			activeContent.classList.remove('hidden')
		}
	}

	// Toggle active/inactive styles on nav links
	function setActiveTab(tabName) {
		// Update the <select> value if it matches the tab name
		// (make sure your <option> values match the data-tab-target or tab text)
		if (selectEl) selectEl.value = tabName

		// Loop through each nav link and adjust classes
		tabLinks.forEach((anchor) => {
			const anchorTabName = getTabIdentifier(anchor)
			const iconEl = anchor.querySelector('svg')

			if (anchorTabName === tabName) {
				// Active tab classes
				anchor.classList.remove(
					'border-transparent',
					'text-gray-500',
					'hover:border-gray-300',
					'hover:text-gray-700'
				)
				anchor.classList.add('primary-border', 'primary-color')
				anchor.setAttribute('aria-current', 'page')

				// Update icon color
				iconEl?.classList.remove(
					'text-gray-400',
					'group-hover:text-gray-500'
				)
				iconEl?.classList.add('primary-color')
			} else {
				// Inactive tab classes
				anchor.classList.remove('primary-border', 'primary-color')
				anchor.classList.add(
					'border-transparent',
					'text-gray-500',
					'hover:border-gray-300',
					'hover:text-gray-700'
				)
				anchor.removeAttribute('aria-current')

				// Update icon color
				iconEl?.classList.remove('primary-color')
				iconEl?.classList.add('text-gray-400', 'group-hover:text-gray-500')
			}
		})

		// Finally, show the correct content
		showTabContent(tabName)
	}

	// Listen for changes in the <select> (mobile dropdown)
	if (selectEl) {
		selectEl.addEventListener('change', function (event) {
			// e.g. "My Account" -> "my-account" if your data attributes are in that format
			const newTabId = event.target.value.toLowerCase().replace(/\s+/g, '-')
			setActiveTab(newTabId)
		})
	}

	// Listen for clicks on each desktop tab
	tabLinks.forEach((anchor) => {
		anchor.addEventListener('click', function (event) {
			event.preventDefault()
			const tabName = getTabIdentifier(anchor)
			setActiveTab(tabName)
		})
	})

	// Initialize the state (the default selected or active tab)
	// e.g. "team-members" from the markup
	const defaultActiveTab = 'info'
	setActiveTab(defaultActiveTab)
})

// Slider
document.addEventListener('DOMContentLoaded', function () {
	const sliders = document.querySelectorAll('.glide')
	const autoPlayCount = 3000
	const isRTL = document.documentElement.dir === 'rtl' // Detect Arabic mode
	sliders.forEach(function (slider, index) {
		try {
			// Assign a unique ID to each slider
			slider.setAttribute('id', `glide-${index}`)
			// console.log(slider.querySelectorAll('.glide__slide'))
			// Initialize Glide for this slider
			new Glide(`#glide-${index}`, {
				autoplay: autoPlayCount,
				type: 'carousel',
				startAt: 0,
				perView: 1,
				direction: isRTL ? 'rtl' : 'ltr',
			}).mount()
		} catch (error) {
			// console.error(`Failed to initialize Glide for slider #${index}`, error)
		}
	})
})

function getContrastYIQ(hexColor) {
	hexColor = hexColor.replace('#', '')

	const r = parseInt(hexColor.substr(0, 2), 16)
	const g = parseInt(hexColor.substr(2, 2), 16)
	const b = parseInt(hexColor.substr(4, 2), 16)

	const yiq = (r * 299 + g * 587 + b * 114) / 1000
	return yiq >= 128 ? '#000000' : '#ffffff'
}

function rgbToHex(rgb) {
	const match = rgb.match(/\d+/g)
	if (!match || match.length < 3) return '#ffffff' // fallback
	const r = parseInt(match[0]).toString(16).padStart(2, '0')
	const g = parseInt(match[1]).toString(16).padStart(2, '0')
	const b = parseInt(match[2]).toString(16).padStart(2, '0')
	return `#${r}${g}${b}`
}

document.querySelectorAll('.custom-badge').forEach((badge) => {
	const bgColor = window.getComputedStyle(badge).backgroundColor
	const hex = rgbToHex(bgColor)
	badge.style.color = getContrastYIQ(hex)
})
