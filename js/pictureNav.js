function KitePictureNav(){
	this.section = document.querySelector( '.picture-nav-section' );
	this.menu = this.section.getElementsByClassName( 'picture-nav' )[0];
	this.mask = this.section.getElementsByClassName( 'picture-nav-mask' )[0];
	this.image = null;
	//this.sourceSet = JSON.parse(this.section.dataset.sources);

	this.getLis = function(){
		if ( ! this.menu ){
			return false;
		}
		let lis = [];
		let currentLi = this.menu.firstChild;
		while ( currentLi ){
			lis.push( currentLi.getElementsByTagName( 'a' )[0] );
			currentLi = currentLi.nextElementSibling;
		}
		this.lis = lis;
	}

	this.handleHover = function( event ){
		const source = event.target.dataset.source;
		if ( source == this.prevImage){
			return;
		}

		this.mask.className += ' fade';

			window.setTimeout( () => {
				this.mask.className = this.mask.className.replace( ' fade', '' );
				if ( ! source ){
					this.prevImage = '#63efa3';
					this.section.style.background = '#63efa3';
				} else{
					this.prevImage = source;
					this.section.style.backgroundImage = "url(" + source + ")";
				}
			}, 300);
			
	}

	this.addListeners = function(){
		const handleHover = this.handleHover.bind(this)
		this.lis.forEach( function(li){
			li.addEventListener( 'mouseenter', handleHover );
		})
	}

	this.run = function(){
		this.getLis();
		this.addListeners();
	}
}

const kitePictureNav = new KitePictureNav();
kitePictureNav.run();

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