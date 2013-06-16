var Portfolio = new Class({
	Implements: Options,
	options: {
		transition: Fx.Transitions.Pow.easeOut,
		fancy: false
	},
	
    initialize: function(portfolio, options) {
		this.items = $$(portfolio);
        this.setOptions(options);
		this.items.each(function(item) {
			this.buildPortfolio(item);
		}.bind(this));
    },


	// this is only needed once for each portfolio item
	buildPortfolio: function(item) {
		// set variables that are needed later
		item.back = item.getElement('.portfolio_back').setStyle('opacity', 0).setStyle('display', 'block');
		item.info = item.getElement('.portfolio_info').setStyle('opacity', 0).setStyle('display', 'block');
		item.thumbnails = item.getElement('.portfolio_thumbnails');
		item.thumbnails.vertical = item.getElement('.portfolio_thumbnails_vertical').setStyle('opacity', 0).setStyle('display', 'block');
		item.thumbs = item.getElements('.portfolio_thumbnails ul li');
		item.thumbs.vertical = item.getElements('.portfolio_thumbnails_vertical ul li');
		item.images = item.getElements('.portfolio_images img');
		item.images.container = item.getElement('.portfolio_images');
		item.content = item.getElement('.portfolio_content');
		item.description = item.getElement('.portfolio_description');
		item.details = item.getElement('.portfolio_details');
		item.number = item.getElement('.portfolio_images_no');
		item.caption = item.getElement('.portfolio_caption').setStyle('opacity', 0).setStyle('display', 'block');
		item.zoomedIn = false;

		// set the image transition for the main view with horizontal thumbnails
		item.thumbs.each(function(thumb, index) {
			thumb.addEvent('mouseenter', function() {
				// if the image is not already active, make it active
				if (!item.images[index].hasClass('active')) {
					// get the current image and fade out
					item.images.active = item.images.container.getElement('.active');
					item.images.active.removeClass('active').get('tween', {
						property: 'opacity',
						duration: 300
					}).start(0);
					
					var fadeout = new Fx.Tween(item.images.active, {
						duration: 300
					}).set('opacity', 1);
					fadeout.start('opacity', 0);
					
					// switch the active thumbnail
					item.thumbs.active = item.thumbnails.getElement('.active');
					item.thumbs.active.removeClass('active');
					thumb.addClass('active');
					
					// fade in new image
					item.images[index].addClass('active').setStyle('opacity', 0).setStyle('display', 'block');
					item.images[index].get('tween', {property: 'opacity', duration: 300, transition: this.options.transition}).start(1);

					// switch the active vertical thumbnail, even though they are currently invisible
					item.thumbs.vertical.active = item.thumbnails.vertical.getElement('.active');
					item.thumbs.vertical.active.removeClass('active');
					item.thumbs.vertical[index].addClass('active');
				}
			}.bind(this));
			
			// on click on a thumbnail, zoom in
			thumb.addEvent('click', function() {
				this.zoomIn(item, index);
			}.bind(this));
			
			// on click on the image, either zoom in or out
			item.images[index].addEvent('click', function() {
				if (!item.zoomedIn) {
					this.zoomIn(item, index);
				} else {
					this.zoomOut(item);
				}
			}.bind(this));
		}.bind(this));
		
		
		// if a vertical thumbnail is clicked
		item.thumbs.vertical.each(function(vthumb, index) {
			vthumb.addEvent('click', function() {
				// if the clicked image is not the current one
				if (!item.images[index].hasClass('active')) {
					
					// remove active from current vthumb and give active to clicked one
					item.thumbs.vertical.active = item.thumbnails.vertical.getElement('.active');
					item.thumbs.vertical.active.removeClass('active');
					vthumb.addClass('active');

					// remove active from current image
					item.images.active = item.images.container.getElement('.active');
					item.images.active.removeClass('active');

					// make the new image active and fade in
					item.images[index].addClass('active').setStyle('opacity', 0).setStyle('display', 'block');
					item.images[index].get('tween', {property: 'opacity', duration: 500}).start(1);

					// fade out the current image
					if (this.options.fancy) {
						new Fx.Morph(item.images.active, {
							duration: 500,
							transition: this.options.transition,
							onComplete: function() {
								item.images.active.setStyle('left', 0);
							}
						}).start({
						    'left': -100,
						    'opacity': 0
						});
					} else {
						new Fx.Morph(item.images.active, {
							duration: 800
						}).start({
						    'opacity': 0
						});
					}
					
					// update caption
					this.setCaption(item, index);
				}
			}.bind(this));
		}.bind(this));
		
		item.back.addEvent('click', function() {
			this.zoomOut(item);
		}.bind(this));
		item.info.addEvent('click', function() {
			this.zoomOut(item);
		}.bind(this));
	},

	
	// switch from main view to detail view
	zoomIn: function(item, index) {
		item.zoomedIn = true;
		item.thumbnails.get('tween', {property: 'opacity', duration: 300}).start(0);
		item.description.get('tween', {property: 'opacity', duration: 300}).start(0);
		item.details.get('tween', {property: 'opacity', duration: 300}).start(0);
		item.number.get('tween', {property: 'opacity', duration: 300}).start(0);
		
		item.back.fade('in');
		item.info.fade('in');
		
		// scale and move the image container
		new Fx.Morph(item.images.container, {
			duration: 800,
			transition: this.options.transition,
			// update dimensions of all images so only the active one needs to be morphed
			onComplete: function() {
				item.images.setStyle('width', '440px').setStyle('height', '300px');
			}
		}).start({
		    'width': 440,
		    'height': 300,
			'left': 20
		});

		// scale the current image to the new container dimensions
		new Fx.Morph(item.images[index], {duration: 800, transition: this.options.transition}).start({
		    'width': 440,
		    'height': 300
		});
		
		// fade in the vertical thumbnails
		new Fx.Morph(item.thumbnails.vertical, {duration: 800, transition: this.options.transition}).start({
		    'right': 13,
		    'opacity': 1
		});
		
		this.setCaption(item, index);
	},


	// switch from detail view back to main view
	zoomOut: function(item) {
		item.zoomedIn = false;
		item.caption.fade('out');
		
		// to avoid problems, set new dimensions to all in-active images before the active one is morphed
		item.images.each(function(img) {
			if (!img.hasClass('active')) img.setStyle('width', '250px').setStyle('height', '170px');
		})
		
		// scale and move the image container
		new Fx.Morph(item.images.container, {
			duration: 800,
			transition: this.options.transition
		}).start({
		    'width': 250,
		    'height': 170,
			'left': 0
		});

		// scale the current image to the new container dimensions
		item.images.active = item.images.container.getElement('.active');
		new Fx.Morph(item.images.active, {duration: 800, transition: this.options.transition}).start({
		    'width': 250,
		    'height': 170
		});
		
		// fade out the vertical thumbnails
		new Fx.Morph(item.thumbnails.vertical, {duration: 800, transition: this.options.transition}).start({
		    'right': 100,
		    'opacity': 0
		});
		
		// scale content area back to main view height
		new Fx.Morph(item.content, {duration: 500, transition: this.options.transition}).start({
			'height': 180
		});

		item.thumbnails.get('tween', {property: 'opacity', duration: 300}).start(1);
		item.description.get('tween', {property: 'opacity', duration: 300}).start(1);
		item.details.get('tween', {property: 'opacity', duration: 300}).start(1);
		item.number.get('tween', {property: 'opacity', duration: 300}).start(1);
		item.getElement('.portfolio_content').setStyle('background-color', '#ffffff')
		
		item.back.fade('out');
		item.info.fade('out');
			
	},


	// update the image caption
	setCaption: function(item, index) {
		// if a caption span exists for this image and is not empty, fade in caption and update text
		if (item.images[index].getNext().match('span') && item.images[index].getNext().get('text') != '') {
			new Fx.Morph(item.content, {duration: 500, transition: this.options.transition}).start({
			    'height': 340
			});
			item.caption.getElement('span').set('text', item.images[index].getNext().get('text'));
			item.caption.get('tween', {property: 'opacity', duration: 150}).start(1);
			
		// if no caption exists, fade out caption area
		} else {
			item.caption.get('tween', {property: 'opacity', duration: 150}).start(0);
			item.getElement('.portfolio_content').setStyle('background-color', '#f6f6f6');
			new Fx.Morph(item.content, {duration: 500, transition: this.options.transition}).start({
			    'height': 315
			});
		}
		
	}

});


window.addEvent('domready', function() {
	new Portfolio('.portfolio');
});