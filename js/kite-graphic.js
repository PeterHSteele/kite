function KiteGraphic(){
    this.next = document.getElementsByClassName( 'nav-next' )[0].getElementsByTagName('a')[0];
    this.prev = document.getElementsByClassName( 'nav-previous' )[0].getElementsByTagName('a')[0];
    this.kite = document.querySelector( '.kite-graphic' );

    this.pointKite = function( className ){
        this.kite.className = this.kite.className += className;
        //this.kite.style.transform = "rotate(" + deg + "deg)";
    }

    this.clearPoint = function( className ){
        this.kite.className = this.kite.className.replace( className, '' )
       // this.kite.style.transform = '';
    }

    this.addListeners = function(){
        const pointKiteRight = this.pointKite.bind(this, ' point-right' );
        const pointKiteLeft = this.pointKite.bind(this, ' point-left' );
        const clearPointLeft = this.clearPoint.bind(this, ' point-left' );
        const clearPointRight = this.clearPoint.bind(this, ' point-right' );

        this.next.addEventListener( 'mouseenter', pointKiteRight );
        this.next.addEventListener( 'mouseleave', clearPointRight )
        this.prev.addEventListener( 'mouseenter', pointKiteLeft );
        this.prev.addEventListener( 'mouseleave', clearPointLeft )
    }
}

const kiteGraphic = new KiteGraphic();
kiteGraphic.addListeners();