jQuery(document).ready(function () {
  // Existing functions
  setHamburgerActiveToggle();
  initializeInspiratieCarousel();
  initializeLogoCarousel();
  initializeCardsCarousel();
  initHeroBannerCarousel();
  toggleMobileSubMenu();
  // setupDesktopDropdowns();
  setupSearchOverlay();
  // Remove handleScroll() from here since it's handled by native JS
  initSmoothScroll(".scroll-down-arrow", 50, 800);
});
jQuery(document).ready(function ($) {
  $("[data-fancybox='gallery']").fancybox({
    thumbs: {
      autoStart: true,
    },
    buttons: ["zoom", "close", "thumbs", "arrowLeft", "arrowRight"],
  });
});

// Search functionality
function setupSearchOverlay() {
  // When search icon is clicked
  jQuery(".search-icon").on("click", function (e) {
    e.preventDefault();
    e.stopPropagation();
    console.log("Search icon clicked");

    // Activate search overlay
    jQuery(".search-overlay").addClass("active");
    jQuery("body").addClass("no-scroll");

    // Focus on search input after animation completes
    setTimeout(function () {
      jQuery(".search-field").focus();
    }, 500);
  });

  // Close search overlay when clicking the close button
  jQuery(".search-close-btn").on("click", function () {
    jQuery(".search-overlay").removeClass("active");
    jQuery("body").removeClass("no-scroll");
  });

  // Close search overlay when pressing ESC key
  jQuery(document).keyup(function (e) {
    if (e.key === "Escape" || e.keyCode === 27) {
      if (jQuery(".search-overlay").hasClass("active")) {
        jQuery(".search-overlay").removeClass("active");
        jQuery("body").removeClass("no-scroll");
      }
    }
  });

  // Prevent clicks inside the overlay from closing it
  jQuery(".search-overlay-content").on("click", function (e) {
    e.stopPropagation();
  });

  // Close overlay when clicking outside the content
  jQuery(".search-overlay").on("click", function () {
    jQuery(this).removeClass("active");
    jQuery("body").removeClass("no-scroll");
  });
}
// Modified toggleMobileSubMenu to work with the new design
function toggleMobileSubMenu() {
  // First remove any existing click handlers to prevent duplicates
  jQuery(".overlay .primary-nav > .menu-item-has-children > a").off("click");

  // Then attach the click handler
  const menuItem = jQuery(
    ".overlay .primary-nav > .menu-item-has-children > a"
  );

  menuItem.on("click", function (e) {
    if (window.innerWidth <= 1000) {
      e.preventDefault();
      e.stopPropagation(); // Stop event bubbling

      const parent = jQuery(this).closest(".menu-item-has-children");

      // Toggle the submenu-open class
      parent.toggleClass("submenu-open");

      // Toggle the show class on the submenu for animations
      const subMenu = parent.find(".sub-menu").first();
      subMenu.toggleClass("show");

      // Close other submenus
      if (parent.hasClass("submenu-open")) {
        parent
          .siblings(".menu-item-has-children.submenu-open")
          .each(function () {
            jQuery(this).removeClass("submenu-open");
            jQuery(this).find(".sub-menu").removeClass("show");
          });
      }
    }
  });

  // // For nested submenus in mobile
  // jQuery(".overlay .sub-menu .menu-item-has-children > a").on(
  //   "click",
  //   function (e) {
  //     if (window.innerWidth <= 1000) {
  //       e.preventDefault();
  //       e.stopPropagation();

  //       const parent = jQuery(this).closest(".menu-item-has-children");
  //       parent.toggleClass("submenu-open");
  //       parent.find(".sub-menu").first().toggleClass("show");
  //     }
  //   }
  // );
}

// Added new function to handle desktop dropdown interactions
function setupDesktopDropdowns() {
  // Add hover functionality for desktop
  jQuery(".nav__container .menu-item-has-children").each(function () {
    // Add indicator for items with children
    if (jQuery(this).find(".sub-menu").length > 0) {
      const menuItemLink = jQuery(this).children("a");

      // Only add indicator if it doesn't already have one
      if (!menuItemLink.find(".dropdown-indicator").length) {
        menuItemLink.append('<span class="dropdown-indicator"></span>');
      }
    }

    // Handle nested dropdowns in desktop mode
    jQuery(this)
      .find(".sub-menu .menu-item-has-children")
      .each(function () {
        const submenuLink = jQuery(this).children("a");

        if (!submenuLink.find(".dropdown-indicator").length) {
          submenuLink.append('<span class="dropdown-indicator">›</span>');
        }
      });
  });
}

function setHamburgerActiveToggle() {
  // Remove any existing click handlers first to prevent duplicates
  jQuery(".mobile-nav-container").off("click");

  // Add the click handler once
  jQuery(".mobile-nav-container").on("click", function (event) {
    // Prevent event bubbling
    event.stopPropagation();

    console.log("trigger");
    jQuery(this).toggleClass("is-active");
    jQuery(".overlay").toggleClass("active");
    jQuery(this).find(".stripe").toggleClass("active");

    if (jQuery(".overlay").get(0)?.classList.contains("active")) {
      jQuery("body").addClass("no-scroll");
      // Reset all open submenus when opening the mobile menu
      jQuery(".menu-item-has-children").removeClass("submenu-open");
      jQuery(".sub-menu").removeClass("show");
    } else {
      jQuery("body").removeClass("no-scroll");
    }
  });
}

function startOwlSlider() {
  jQuery(".owl-carousel").owlCarousel({
    dots: false,
    nav: true,
    margin: 12,
    navText: [
      '<img class="checkmark" src="/wp-content/themes/valkentij-theme/images/check.svg" alt="checkmark icon">',
      '<img class="checkmark" src="/wp-content/themes/valkentij-theme/images/check.svg" alt="checkmark icon">',
    ],
    responsive: {
      0: {
        items: 1,
        stagePadding: 32,
      },
      768: {
        items: 2,
      },
      1199: {
        items: 3,
      },
    },
  });
}

// AJAX FILTERS
function postcodeAutofill() {
  console.log("main.js loaded");
  jQuery("#input_3_7").on("change", function () {
    console.log("input jquery hi!");

    // Get the value from the input field
    var postcodeValue = jQuery("#input_3_3").val();
    var houseNumberValue = jQuery(this).val();

    jQuery.ajax({
      // Use the input value in the URL
      url:
        "https://postcode.tech/api/v1/postcode?postcode=" +
        encodeURIComponent(postcodeValue) +
        "&number=" +
        encodeURIComponent(houseNumberValue),
      headers: {
        Authorization: "Bearer 28d9bd81-3f4d-4cec-a05d-4ec732e9f578",
      },
      method: "GET",

      success: function (data) {
        jQuery("#input_3_5").val(data.city);
        // Handle the successful response
        console.log(data);
        // Populate Gravity Forms fields with the received data
        // populateGravityFormsFields(data);
      },
      error: function (error) {
        // Handle errors
        console.error("Error fetching KVK data:", error);
      },
    });
  });
}
function setOnBtnAjaxFilter() {
  jQuery(".filter-change").on("change", function () {
    jQuery("#all-projects").addClass("fade-out");
    jQuery("#loader").show();

    jQuery.ajax({
      //object from functions.php
      url: ajax_object.ajax_url,
      type: "POST",
      data: {
        action: "filter_projects",
        filters: {
          budget: {
            budgetFrom: jQuery("input[name='budget-from']").val(),
            budgetTo: jQuery("input[name='budget-to']").val(),
            field: "budget",
          },
          stays: {
            staysAmount: jQuery("#filter-stays").val(),
            field: "aantal_nachten",
          },
          people: {
            peopleAmount: jQuery("#filter-people").val(),
            field: "max_aantal_bruiloftsgasten",
          },
        },
      },
      success: function (response) {
        var responseData = JSON.parse(response);
        var htmlContent = responseData.html;
        var postCount = responseData.postCount;

        jQuery("#loader").hide();
        jQuery("#all-projects").html(htmlContent);
        jQuery("#all-projects").css("opcacity", 1);
        jQuery("#all-projects").removeClass("fade-out");
        jQuery("#filter-results").text(postCount);
      },
    });
  });
}
function initializeInspiratieCarousel() {
  jQuery(".inspiratie-carousel").owlCarousel({
    items: 3,
    margin: 15,
    nav: false,
    dots: false,
    stagePadding: 100, // Default stage padding
    responsive: {
      0: {
        // Mobile view
        items: 1,
        stagePadding: 50,
        center: true,
        loop: true,
        autoplay: true,
      },
      768: {
        // Tablet and desktop
        items: 3,
        stagePadding: 150, // Different stage padding for larger screens
        center: false,
        loop: false,
      },
    },
  });
}
function initializeCardsCarousel() {
  jQuery(".cards-carousel").owlCarousel({
    loop: true,
    margin: 30,
    nav: true, // enable navigation arrows
    navText: [
      '<span class="owl-prev-icon" style="color:white;">&#10094;</span>',
      '<span class="owl-next-icon" style="color:white;">&#10095;</span>',
    ],
    dots: true,
    dotsEach: true,
    autoplay: true,
    responsive: {
      0: {
        items: 1,
      },
      576: {
        items: 1,
        stagePadding: 60,
      },
      768: {
        items: 2,
        stagePadding: 60,
      },
      992: {
        items: 3,
        stagePadding: 0,
      },
      1200: {
        items: 4,
        stagePadding: 0,
      },
    },
  });
}

function initializeLogoCarousel() {
  jQuery(".logo-carousel").owlCarousel({
    items: 3,
    margin: 15,
    nav: false,
    dots: false,
    autoplay: true,
    stagePadding: 100,
    loop: true,
    responsive: {
      0: {
        items: 1,
        stagePadding: 50,
        center: true,
      },
      768: {
        items: 3,
        stagePadding: 150,
        center: false,
      },
    },
  });
}

document.addEventListener("DOMContentLoaded", function () {
  const headerLogo = document.querySelector(".header-logo");
  const logoImg = headerLogo.querySelector("img");

  const originalHeight = logoImg ? logoImg.height : "auto";

  function handleScroll() {
    if (window.scrollY > 0) {
      if (logoImg) {
        logoImg.style.height = "80px";
        logoImg.style.transition = "height 0.3s ease";
      }

      headerLogo.classList.add("scrolled");
    } else {
      if (logoImg) {
        logoImg.style.height = originalHeight + "px";
      }
      headerLogo.classList.remove("scrolled");
    }
  }

  window.addEventListener("scroll", handleScroll);
});
document.addEventListener("DOMContentLoaded", () => {
  let page = blogLoadConfig.currentPage + 1;
  const maxPages = blogLoadConfig.maxPages;
  const loadMoreBtn = document.getElementById("load-more-btn");
  const postContainer = document.getElementById("post-container");

  function loadMorePosts() {
    loadMoreBtn.disabled = true;
    loadMoreBtn.innerText = "Bezig...";

    fetch(`${blogLoadConfig.ajaxUrl}?action=load_more_posts&page=${page}`)
      .then((res) => res.text())
      .then((data) => {
        postContainer.insertAdjacentHTML("beforeend", data);
        page++;

        if (page > maxPages) {
          loadMoreBtn.style.display = "none";
        } else {
          loadMoreBtn.disabled = false;
          loadMoreBtn.innerText = "Meer laden";
        }
      })
      .catch(() => {
        loadMoreBtn.innerText = "probeer opnieuw";
        loadMoreBtn.disabled = false;
      });
  }

  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", loadMorePosts);
  }
});
function initHeroBannerCarousel() {
  jQuery(document).ready(function ($) {
    $(".hero-banner.owl-carousel").owlCarousel({
      items: 1,
      loop: true,
      margin: 0,
      nav: false,
      dots: false,
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 3000,
      smartSpeed: 500,
    });
  });
}
function initSmoothScroll(selector, offset, speed) {
  // Set default values if arguments are not provided
  selector = selector || ".scroll-down-arrow";
  offset = offset || 50;
  speed = speed || 800;

  const $scrollLinks = jQuery(selector);

  // Check if any trigger elements exist on the page
  if ($scrollLinks.length) {
    $scrollLinks.on("click", function (event) {
      // Use the href attribute (this.hash) to find the target element's ID
      const targetId = this.hash;
      const $target = jQuery(targetId);

      // Ensure the target element actually exists
      if ($target.length) {
        // Prevent the default browser jump
        event.preventDefault();

        // Animate the scroll
        jQuery("html, body").animate(
          {
            scrollTop: $target.offset().top - offset,
          },
          speed
        );
      }
    });
  }
}
