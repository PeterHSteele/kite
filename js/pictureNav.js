function KitePictureNav(){
	this.section = document.querySelector( '.kite-picture-nav' );
	this.menu = section.getElementsByClassName( 'picture-nav' )[0];
	this.sources = this.section.dataset.sources;
	this.lis = this.getLis();

	this.getLis = function(){
		if ( ! this.menu ){
			return false;
		}
		let lis = [];
		let currentLi = this.menu.firstChild;
		while ( currentLi ){
			lis.push( currentLi )
			currentChild = currentLi.nextSibling;
		}
	}

	this.handleHover = function(){
		this.section.style.backgroundImage = this.sources[0];
	}

	this.test = function(){
		console.log('sources', this.sources);
	}

	this.addListeners = function(){
		this.lis.forEach( function(li){
			li.addEventListener( 'mouseenter', this.handleHover.bind(this) );
		})
	}

	this.run = function(){
		this.test();
	}
}

const kitePictureNav = new KitePictureNav();
kitePictureNav.run();