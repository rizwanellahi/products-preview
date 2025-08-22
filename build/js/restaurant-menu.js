(() => {
  // resources/js/components/restaurant-menu.js
  function fn() {
    const sectionsContainer = document.querySelector(".page-sections");
    const sections = document.querySelectorAll(".page-section");
    const nav = document.querySelector(".nav-sections");
    if (nav) {
      const menu = nav.querySelector(".menu");
      const links = nav.querySelectorAll(".menu-item-link");
      const activeLine = nav.querySelector(".active-line");
      const sectionOffset = nav.offsetHeight + 24;
      const activeClass = "active";
      let activeIndex = 0;
      let isScrolling = true;
      let userScroll = true;
      const setActiveClass = () => {
        if (activeIndex >= 0 && activeIndex < links.length) {
          links[activeIndex].classList.add(activeClass);
        }
      };
      const removeActiveClass = () => {
        if (activeIndex >= 0 && activeIndex < links.length) {
          links[activeIndex].classList.remove(activeClass);
        }
      };
      setActiveClass();
      const moveActiveLine = () => {
        if (activeIndex < 0 || activeIndex >= links.length) {
          return;
        }
        const link = links[activeIndex];
        if (!link) {
          return;
        }
        const linkRect = link.getBoundingClientRect();
        const menuRect = menu.getBoundingClientRect();
        activeLine.style.transform = `translateX(${menu.scrollLeft - menuRect.x + linkRect.x}px)`;
        activeLine.style.width = `${link.offsetWidth}px`;
      };
      const setMenuLeftPosition = (position) => {
        menu.scrollTo({
          left: position,
          behavior: "smooth"
        });
      };
      const checkMenuOverflow = () => {
        if (activeIndex < 0 || activeIndex >= links.length) {
          return;
        }
        const activeLink = links[activeIndex].getBoundingClientRect();
        const offset = 30;
        if (Math.floor(activeLink.right) > window.innerWidth) {
          setMenuLeftPosition(menu.scrollLeft + activeLink.right - window.innerWidth + offset);
        } else if (activeLink.left < 0) {
          setMenuLeftPosition(menu.scrollLeft + activeLink.left - offset);
        }
      };
      const handleActiveLinkUpdate = (current) => {
        removeActiveClass();
        activeIndex = current;
        checkMenuOverflow();
        setActiveClass();
        moveActiveLine();
      };
      const init = () => {
        moveActiveLine(links[0]);
        document.documentElement.style.setProperty("--section-offset", sectionOffset);
      };
      init();
      links.forEach((link, index) => {
        link.addEventListener("click", (e) => {
          e.preventDefault();
          userScroll = false;
          handleActiveLinkUpdate(index);
          const sectionTop = sections[index].getBoundingClientRect().top + window.pageYOffset;
          window.scrollTo({
            top: sectionTop - sectionOffset,
            behavior: "smooth"
          });
        });
      });
      window.addEventListener("scroll", () => {
        const currentIndex = sectionsContainer.getBoundingClientRect().top < 0 ? sections.length - 1 - [...sections].reverse().findIndex((section) => window.pageYOffset >= section.getBoundingClientRect().top + window.pageYOffset - sectionOffset * 2) : 0;
        if (userScroll && activeIndex !== currentIndex) {
          handleActiveLinkUpdate(currentIndex);
        } else {
          window.clearTimeout(isScrolling);
          isScrolling = setTimeout(() => userScroll = true, 100);
        }
      });
    }
  }
  window.addEventListener("DOMContentLoaded", fn, false);
})();
