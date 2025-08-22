(() => {
  // resources/js/app.js
  document.addEventListener("DOMContentLoaded", function() {
    MicroModal.init({
      disableScroll: true,
      awaitCloseAnimation: true
    });
    const categoryLinks = document.querySelectorAll(".category-item a");
    categoryLinks.forEach((link) => {
      link.addEventListener("click", function(event) {
        event.preventDefault();
        const targetSectionId = this.getAttribute("href");
        MicroModal.close("menu-cat");
        setTimeout(function() {
          if (targetSectionId) {
            window.location.hash = targetSectionId;
            const targetElement = document.querySelector(targetSectionId);
            if (targetElement) {
              targetElement.scrollIntoView({
                behavior: "smooth",
                block: "start"
              });
            }
          }
        }, 200);
      });
    });
    var shareBtnx = document.getElementById("share-btn-x");
    shareBtnx.addEventListener("click", function(event) {
      event.preventDefault();
      const currentUrl = window.location.href;
      if (navigator.share) {
        navigator.share({
          title: "Digital Menu - Designed by logix360.studio",
          text: "Digital Menu:",
          url: currentUrl
        }).then(() => console.log("Share successful")).catch((error) => console.error("Error sharing:", error));
      } else {
        alert("Sharing is not supported in this browser. Please copy the link: " + currentUrl);
      }
    });
    var shareBtnHeader = document.getElementById("share-btn-header");
    shareBtnHeader.addEventListener("click", function(event) {
      event.preventDefault();
      const currentUrl = window.location.href;
      if (navigator.share) {
        navigator.share({
          title: "Digital Menu - Designed by logix360.studio",
          text: "Digital Menu:",
          url: currentUrl
        }).then(() => console.log("Share successful")).catch((error) => console.error("Error sharing:", error));
      } else {
        alert("Sharing is not supported in this browser. Please copy the link: " + currentUrl);
      }
    });
    var qrCodeImg = document.querySelector("#qr-code img");
    var downloadBtn = document.getElementById("download-btn");
    if (qrCodeImg && downloadBtn) {
      qrCodeImg.addEventListener("load", function() {
        var qrCodeSrc2 = qrCodeImg.getAttribute("src") || qrCodeImg.getAttribute("data-src");
        if (qrCodeSrc2) {
          downloadBtn.href = qrCodeSrc2;
        }
      });
      if (qrCodeImg.complete) {
        var qrCodeSrc = qrCodeImg.getAttribute("src") || qrCodeImg.getAttribute("data-src");
        if (qrCodeSrc) {
          downloadBtn.href = qrCodeSrc;
        }
      }
    }
  });
  document.addEventListener("DOMContentLoaded", function() {
    const selectEl = document.getElementById("tabs-select");
    const tabLinks = document.querySelectorAll("#tabs-nav a");
    const tabContents = document.querySelectorAll("[data-tab-content]");
    function getTabIdentifier(anchor) {
      const dataTarget = anchor.getAttribute("data-tab-target");
      if (dataTarget)
        return dataTarget;
      return anchor.querySelector("span")?.textContent.trim().toLowerCase().replace(/\s+/g, "-");
    }
    function showTabContent(tabId) {
      tabContents.forEach((content) => {
        content.classList.add("hidden");
      });
      const activeContent = document.querySelector(`[data-tab-content="${tabId}"]`);
      if (activeContent) {
        activeContent.classList.remove("hidden");
      }
    }
    function setActiveTab(tabName) {
      if (selectEl)
        selectEl.value = tabName;
      tabLinks.forEach((anchor) => {
        const anchorTabName = getTabIdentifier(anchor);
        const iconEl = anchor.querySelector("svg");
        if (anchorTabName === tabName) {
          anchor.classList.remove("border-transparent", "text-gray-500", "hover:border-gray-300", "hover:text-gray-700");
          anchor.classList.add("primary-border", "primary-color");
          anchor.setAttribute("aria-current", "page");
          iconEl?.classList.remove("text-gray-400", "group-hover:text-gray-500");
          iconEl?.classList.add("primary-color");
        } else {
          anchor.classList.remove("primary-border", "primary-color");
          anchor.classList.add("border-transparent", "text-gray-500", "hover:border-gray-300", "hover:text-gray-700");
          anchor.removeAttribute("aria-current");
          iconEl?.classList.remove("primary-color");
          iconEl?.classList.add("text-gray-400", "group-hover:text-gray-500");
        }
      });
      showTabContent(tabName);
    }
    if (selectEl) {
      selectEl.addEventListener("change", function(event) {
        const newTabId = event.target.value.toLowerCase().replace(/\s+/g, "-");
        setActiveTab(newTabId);
      });
    }
    tabLinks.forEach((anchor) => {
      anchor.addEventListener("click", function(event) {
        event.preventDefault();
        const tabName = getTabIdentifier(anchor);
        setActiveTab(tabName);
      });
    });
    const defaultActiveTab = "info";
    setActiveTab(defaultActiveTab);
  });
  document.addEventListener("DOMContentLoaded", function() {
    const sliders = document.querySelectorAll(".glide");
    const autoPlayCount = 3e3;
    const isRTL = document.documentElement.dir === "rtl";
    sliders.forEach(function(slider, index) {
      try {
        slider.setAttribute("id", `glide-${index}`);
        new Glide(`#glide-${index}`, {
          autoplay: autoPlayCount,
          type: "carousel",
          startAt: 0,
          perView: 1,
          direction: isRTL ? "rtl" : "ltr"
        }).mount();
      } catch (error) {
      }
    });
  });
  function getContrastYIQ(hexColor) {
    hexColor = hexColor.replace("#", "");
    const r = parseInt(hexColor.substr(0, 2), 16);
    const g = parseInt(hexColor.substr(2, 2), 16);
    const b = parseInt(hexColor.substr(4, 2), 16);
    const yiq = (r * 299 + g * 587 + b * 114) / 1e3;
    return yiq >= 128 ? "#000000" : "#ffffff";
  }
  function rgbToHex(rgb) {
    const match = rgb.match(/\d+/g);
    if (!match || match.length < 3)
      return "#ffffff";
    const r = parseInt(match[0]).toString(16).padStart(2, "0");
    const g = parseInt(match[1]).toString(16).padStart(2, "0");
    const b = parseInt(match[2]).toString(16).padStart(2, "0");
    return `#${r}${g}${b}`;
  }
  document.querySelectorAll(".custom-badge").forEach((badge) => {
    const bgColor = window.getComputedStyle(badge).backgroundColor;
    const hex = rgbToHex(bgColor);
    badge.style.color = getContrastYIQ(hex);
  });
})();
