function Kite_Main_Navigation(){
		this.menuToggle = document.querySelector( '.menu-toggle' );
		this.nav = document.querySelector( '.main-navigation' );
		this.searchForm = document.getElementsByClassName( 'site-header' )[0].getElementsByClassName( 'search-form' )[0];
		this.searchInput = this.searchForm.getElementsByClassName( 'search-field' )[0]
		this.searchToggle = document.querySelector( '.search-toggle' );
		this.navLinks = this.nav.getElementsByTagName( 'a' );
		this.wheelOpt = false;
		this.keys = {37: 1, 38: 1, 39: 1, 40: 1};
		this.close = document.getElementsByClassName( 'nav-close' );

		/*this.handleScroll = function(){
			this.nav.style.top = window.scrollY + 'px';
		}*/

		this.handleKeyPress = function( e ){
			if ( this.nav.className.indexOf('menu-active') > 0 ){
				if ( this.keys[e.keyCode] ){
					e.preventDefault();
				} else if ( e.keyCode === 9 ){
					this.toggle();
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

		this.setExpanded = function ( ele ){
			this.expanded = ele;
		}

		this.toggle = function( ele ){
			if ( typeof ele === 'function'){
				ele = ele();
			}
			if ( ele.className.indexOf('menu-active') > -1 ){
				ele.classList = ele.className.replace( ' menu-active', '' );
				this.expanded = '';
				this.enableScrolling();
			} else {
				ele.className += ' menu-active';
				this.expanded = ele;
				if ( ele.className.indexOf('search-form') > -1 ){
					const { searchInput } = this;
					searchInput.select();
					const start = searchInput.selectionStart,
					end = searchInput.selectionEnd;
					searchInput.focus();
					if ( end ){
						searchInput.setSelectionRange( end, end );
					}
				}
			}
		}

		this.getExpanded = function(){
			console.log('getting');
			return this.expanded;
		}

		this.open = function( ele ){
			if ( ele.className.indexOf('menu-active') < 0 ){
				ele.className += ' menu-active';
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
			this.menuToggle.addEventListener( 'click' , this.toggle.bind( this, this.nav ));
			this.searchToggle.addEventListener( 'click', this.toggle.bind( this, this.searchForm ));

			Array
				.from(this.close)
				.forEach( closeBtn => closeBtn.addEventListener( 
					'click', 
					this.toggle.bind( 
						this, 
						this.getExpanded.bind(this) 
			)));

			this.boundOpen = this.open.bind(this, this.nav);
			for ( let i = 0; i< this.navLinks.length; i++){
				this.navLinks[i].addEventListener( 'focus', this.boundOpen );
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