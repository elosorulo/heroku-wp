/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
    var cutemag_secondary_container, cutemag_secondary_button, cutemag_secondary_menu, cutemag_secondary_links, cutemag_secondary_i, cutemag_secondary_len;

    cutemag_secondary_container = document.getElementById( 'cutemag-secondary-navigation' );
    if ( ! cutemag_secondary_container ) {
        return;
    }

    cutemag_secondary_button = cutemag_secondary_container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof cutemag_secondary_button ) {
        return;
    }

    cutemag_secondary_menu = cutemag_secondary_container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof cutemag_secondary_menu ) {
        cutemag_secondary_button.style.display = 'none';
        return;
    }

    cutemag_secondary_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === cutemag_secondary_menu.className.indexOf( 'nav-menu' ) ) {
        cutemag_secondary_menu.className += ' nav-menu';
    }

    cutemag_secondary_button.onclick = function() {
        if ( -1 !== cutemag_secondary_container.className.indexOf( 'cutemag-toggled' ) ) {
            cutemag_secondary_container.className = cutemag_secondary_container.className.replace( ' cutemag-toggled', '' );
            cutemag_secondary_button.setAttribute( 'aria-expanded', 'false' );
            cutemag_secondary_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            cutemag_secondary_container.className += ' cutemag-toggled';
            cutemag_secondary_button.setAttribute( 'aria-expanded', 'true' );
            cutemag_secondary_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the link elements within the menu.
    cutemag_secondary_links    = cutemag_secondary_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( cutemag_secondary_i = 0, cutemag_secondary_len = cutemag_secondary_links.length; cutemag_secondary_i < cutemag_secondary_len; cutemag_secondary_i++ ) {
        cutemag_secondary_links[cutemag_secondary_i].addEventListener( 'focus', cutemag_secondary_toggleFocus, true );
        cutemag_secondary_links[cutemag_secondary_i].addEventListener( 'blur', cutemag_secondary_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function cutemag_secondary_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'cutemag-focus' ) ) {
                    self.className = self.className.replace( ' cutemag-focus', '' );
                } else {
                    self.className += ' cutemag-focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( cutemag_secondary_container ) {
        var touchStartFn, cutemag_secondary_i,
            parentLink = cutemag_secondary_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, cutemag_secondary_i;

                if ( ! menuItem.classList.contains( 'cutemag-focus' ) ) {
                    e.preventDefault();
                    for ( cutemag_secondary_i = 0; cutemag_secondary_i < menuItem.parentNode.children.length; ++cutemag_secondary_i ) {
                        if ( menuItem === menuItem.parentNode.children[cutemag_secondary_i] ) {
                            continue;
                        }
                        menuItem.parentNode.children[cutemag_secondary_i].classList.remove( 'cutemag-focus' );
                    }
                    menuItem.classList.add( 'cutemag-focus' );
                } else {
                    menuItem.classList.remove( 'cutemag-focus' );
                }
            };

            for ( cutemag_secondary_i = 0; cutemag_secondary_i < parentLink.length; ++cutemag_secondary_i ) {
                parentLink[cutemag_secondary_i].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( cutemag_secondary_container ) );
} )();


( function() {
    var cutemag_primary_container, cutemag_primary_button, cutemag_primary_menu, cutemag_primary_links, cutemag_primary_i, cutemag_primary_len;

    cutemag_primary_container = document.getElementById( 'cutemag-primary-navigation' );
    if ( ! cutemag_primary_container ) {
        return;
    }

    cutemag_primary_button = cutemag_primary_container.getElementsByTagName( 'button' )[0];
    if ( 'undefined' === typeof cutemag_primary_button ) {
        return;
    }

    cutemag_primary_menu = cutemag_primary_container.getElementsByTagName( 'ul' )[0];

    // Hide menu toggle button if menu is empty and return early.
    if ( 'undefined' === typeof cutemag_primary_menu ) {
        cutemag_primary_button.style.display = 'none';
        return;
    }

    cutemag_primary_menu.setAttribute( 'aria-expanded', 'false' );
    if ( -1 === cutemag_primary_menu.className.indexOf( 'nav-menu' ) ) {
        cutemag_primary_menu.className += ' nav-menu';
    }

    cutemag_primary_button.onclick = function() {
        if ( -1 !== cutemag_primary_container.className.indexOf( 'cutemag-toggled' ) ) {
            cutemag_primary_container.className = cutemag_primary_container.className.replace( ' cutemag-toggled', '' );
            cutemag_primary_button.setAttribute( 'aria-expanded', 'false' );
            cutemag_primary_menu.setAttribute( 'aria-expanded', 'false' );
        } else {
            cutemag_primary_container.className += ' cutemag-toggled';
            cutemag_primary_button.setAttribute( 'aria-expanded', 'true' );
            cutemag_primary_menu.setAttribute( 'aria-expanded', 'true' );
        }
    };

    // Get all the link elements within the menu.
    cutemag_primary_links    = cutemag_primary_menu.getElementsByTagName( 'a' );

    // Each time a menu link is focused or blurred, toggle focus.
    for ( cutemag_primary_i = 0, cutemag_primary_len = cutemag_primary_links.length; cutemag_primary_i < cutemag_primary_len; cutemag_primary_i++ ) {
        cutemag_primary_links[cutemag_primary_i].addEventListener( 'focus', cutemag_primary_toggleFocus, true );
        cutemag_primary_links[cutemag_primary_i].addEventListener( 'blur', cutemag_primary_toggleFocus, true );
    }

    /**
     * Sets or removes .focus class on an element.
     */
    function cutemag_primary_toggleFocus() {
        var self = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

            // On li elements toggle the class .focus.
            if ( 'li' === self.tagName.toLowerCase() ) {
                if ( -1 !== self.className.indexOf( 'cutemag-focus' ) ) {
                    self.className = self.className.replace( ' cutemag-focus', '' );
                } else {
                    self.className += ' cutemag-focus';
                }
            }

            self = self.parentElement;
        }
    }

    /**
     * Toggles `focus` class to allow submenu access on tablets.
     */
    ( function( cutemag_primary_container ) {
        var touchStartFn, cutemag_primary_i,
            parentLink = cutemag_primary_container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

        if ( 'ontouchstart' in window ) {
            touchStartFn = function( e ) {
                var menuItem = this.parentNode, cutemag_primary_i;

                if ( ! menuItem.classList.contains( 'cutemag-focus' ) ) {
                    e.preventDefault();
                    for ( cutemag_primary_i = 0; cutemag_primary_i < menuItem.parentNode.children.length; ++cutemag_primary_i ) {
                        if ( menuItem === menuItem.parentNode.children[cutemag_primary_i] ) {
                            continue;
                        }
                        menuItem.parentNode.children[cutemag_primary_i].classList.remove( 'cutemag-focus' );
                    }
                    menuItem.classList.add( 'cutemag-focus' );
                } else {
                    menuItem.classList.remove( 'cutemag-focus' );
                }
            };

            for ( cutemag_primary_i = 0; cutemag_primary_i < parentLink.length; ++cutemag_primary_i ) {
                parentLink[cutemag_primary_i].addEventListener( 'touchstart', touchStartFn, false );
            }
        }
    }( cutemag_primary_container ) );
} )();