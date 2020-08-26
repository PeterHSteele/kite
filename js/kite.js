function Kite_Main_Navigation(){
		this.toggle = document.querySelector( '.menu-toggle' );
		this.nav = document.querySelector( '.main-navigation' );
		this.navLinks = this.nav.getElementsByTagName( 'a' );
		this.wheelOpt = false;
		this.keys = {37: 1, 38: 1, 39: 1, 40: 1};
		this.close = document.querySelector( '.nav-close' );

		/*this.handleScroll = function(){
			this.nav.style.top = window.scrollY + 'px';
		}*/

		this.handleKeyPress = function( e ){
			if ( this.nav.className.indexOf('menu-active') > 0 ){
				if ( this.keys[e.keyCode] ){
					e.preventDefault();
				} else if ( e.keyCode === 9 ){
					this.toggleNav();
				}
			}
		}

		this.checkPassiveSupported = function(){
			let passiveSupport = false

			try {
				window.addEventListener( 'test' , null, {
					get passive(){
						passiveSupport = true
						return false;
					}
				})
			} catch ( error ){}

			return passiveSupport ? { passive : false } : false;
		}

		this.preventDefault = function(e){
			e.preventDefault();
		}

		this.toggleNav = function(){
			if ( this.nav.className.indexOf('menu-active') > -1 ){
				this.nav.classList = this.nav.className.replace( ' menu-active', '' );
				this.enableScrolling();
			} else {
				this.nav.className += ' menu-active';
				this.disableScrolling();
			}
		}

		this.openNav = function(){
			if ( this.nav.className.indexOf('menu-active') < 0 ){
				this.nav.className += ' menu-active';
				this.disableScrolling();
			}
		}

		this.disableScrolling = function(){
			this.boundHandleKeyPress = this.handleKeyPress.bind(this);
			window.addEventListener( 'wheel', this.preventDefault, this.wheelOpt);
			window.addEventListener( 'keydown', this.boundHandleKeyPress );
			window.addEventListener( 'touchmove', this.preventDefault, false);
			
		}

		this.enableScrolling = function(){
			window.removeEventListener( 'wheel', this.preventDefault, this.wheelOpt);
			window.removeEventListener( 'keydown', this.boundHandleKeyPress );
			window.removeEventListener( 'touchmove', this.preventDefault, false);
		}

		this.addListeners = function(){
			//const handleScroll 	   = this.handleScroll.bind( this );

			//let cooldown, endScrollHandle;
			this.toggle.addEventListener( 'click' , this.toggleNav.bind( this ));
			this.close.addEventListener( 'click', this.toggleNav.bind( this ));

			this.boundOpenNav = this.openNav.bind(this)
			for ( let i = 0; i< this.navLinks.length; i++){
				this.navLinks[i].addEventListener( 'focus', this.boundOpenNav );
			}

			/*window.addEventListener( 'scroll', function(){
				if ( cooldown ) return;
				cooldown = true;
				clearTimeout( endScrollHandle );
				handleScroll();
				setTimeout( function(){
					cooldown = false;
				}, 150 )
				endScrollHandle = window.setTimeout( handleScroll, 200 );
			});*/
		}

		this.run = function(){
			this.wheelOpt = this.checkPassiveSupported();
			this.addListeners();
		}
	}

	const kiteNavFunctions = new Kite_Main_Navigation();
	kiteNavFunctions.run();

function Kite_Parallax(){
	this.image = document.querySelector( '.kite-parallax-image' );
	this.imageSectionOffset = this.image.getBoundingClientRect().top

	

	this.handleScroll = function(){
		this.image.style.transform = 'translate3d( 0px,' +(-1 * this.image.getBoundingClientRect().top/2)  + 'px, 0px)';
	}

	this.addListeners = function(){
		document.addEventListener( 'scroll', this.handleScroll.bind(this) );
	}
}


const kiteParallax = new Kite_Parallax();
kiteParallax.addListeners();

