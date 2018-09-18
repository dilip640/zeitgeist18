jQuery(document).ready(function(){
	var intro = $('.cd-intro-block'),
		projectsContainer = $('.cd-projects-wrapper'),
		projectsSlider = projectsContainer.children('.cd-slider'),
		singleProjectContent = $('.cd-project-content'),
		sliderNav = $('.cd-slider-navigation');

	var resizing = false;
	var top = window.pageYOffset || document.documentElement.scrollTop;
	//if on desktop - set a width for the projectsSlider element
	setSliderContainer();
	$(window).on('resize', function(){
		//on resize - update projectsSlider width and translate value
		if( !resizing ) {
			(!window.requestAnimationFrame) ? setSliderContainer() : window.requestAnimationFrame(setSliderContainer);
			resizing = true;
		}
	});


	//select a single project - open project-content panel
	projectsContainer.on('click', '.cd-slider a', function(event) {
		var mq = checkMQ();
		event.preventDefault();
		if( $(this).parent('li').next('li').is('.current') && (mq == 'desktop') ) {
			prevSides(projectsSlider);
		} else if ( $(this).parent('li').prev('li').prev('li').prev('li').is('.current')  && (mq == 'desktop') ) {
			nextSides(projectsSlider);
		} else {
			var selected_event=$(this).attr('href');
			$('#after_load').css({ 'z-index' : '4', 'opacity' : '1' });
				$("#main").load("all_events/"+selected_event, function(responseTxt, statusTxt, xhr){
				if(statusTxt == "success"){
					if(mq!='desktop'){
						top = top = window.pageYOffset || document.documentElement.scrollTop;
						projectsContainer.addClass('remove_scroll');
					}
					singleProjectContent.addClass('is-visible');
					$('#after_load').css({ 'z-index' : '-1', 'opacity' : '0' });
				}
				if(statusTxt == "error"){
					$('#after_load').css({ 'z-index' : '-1', 'opacity' : '0' });
					alert("Event Not Found!");
				}
			});
			
			
		}
	});

	//close single project content
	singleProjectContent.on('click', '.close', function(event){
		event.preventDefault();
		singleProjectContent.removeClass('is-visible');
		if(checkMQ()!='desktop'){
				projectsContainer.removeClass('remove_scroll');
				window.scrollTo(0,top);
		}
		
	});

	//go to next/pre slide - clicking on the next/prev arrow
	sliderNav.on('click', '.next', function(){
		nextSides(projectsSlider);
	});
	sliderNav.on('click', '.prev', function(){
		prevSides(projectsSlider);
	});

	//go to next/pre slide - keyboard navigation
	$(document).keyup(function(event){
		var mq = checkMQ();
		if(event.which=='37' &&  intro.hasClass('projects-visible') && !(sliderNav.find('.prev').hasClass('inactive')) && (mq == 'desktop') ) {
			prevSides(projectsSlider);
		} else if( event.which=='39' &&  intro.hasClass('projects-visible') && !(sliderNav.find('.next').hasClass('inactive')) && (mq == 'desktop') ) {
			nextSides(projectsSlider);
		} else if(event.which=='27' && singleProjectContent.hasClass('is-visible')) {
			singleProjectContent.removeClass('is-visible');
		}
	});
	var doScroll = function(e) {
		const deltaX = Math.max(-1, Math.min(1, e.deltaX));
		var mq = checkMQ();
		if(e.deltaX>0&&e.deltaX<10)
			if( !(sliderNav.find('.next').hasClass('inactive')) && (mq == 'desktop') ) nextSides(projectsSlider);
		if(e.deltaX<0&&e.deltaX>-10)
			if ( !(sliderNav.find('.prev').hasClass('inactive')) && (mq == 'desktop') ) prevSides(projectsSlider);
	};

	if (window.addEventListener) {
		window.addEventListener("wheel", doScroll, false);
	}

	function showProjectPreview(project) {
		if(project.length > 0 ) {
			setTimeout(function(){
				project.addClass('slides-in');
				showProjectPreview(project.next());
			}, 50);
		}
	}

	function checkMQ() {
		//check if mobile or desktop device
		return window.getComputedStyle(document.querySelector('.cd-projects-wrapper'), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "");
	}

	function setSliderContainer() {
		var mq = checkMQ();
		if(mq == 'desktop') {
			var	slides = projectsSlider.children('li'),
				slideWidth = slides.eq(0).width(),
				marginLeft = Number(projectsSlider.children('li').eq(1).css('margin-left').replace('px', '')),
				sliderWidth = ( slideWidth + marginLeft )*( slides.length + 1 ) + 'px',
				slideCurrentIndex = projectsSlider.children('li.current').index();
			projectsSlider.css('width', sliderWidth);
			( slideCurrentIndex != 0 ) && setTranslateValue(projectsSlider, (  slideCurrentIndex * (slideWidth + marginLeft) + 'px'));
		} else {
			projectsSlider.css('width', '');
			setTranslateValue(projectsSlider, 0);
		}
		resizing = false;
	}

	function nextSides(slider) {
		var actual = slider.children('.current'),
			index = actual.index(),
			following = actual.nextAll('li').length,
			width = actual.width(),
			marginLeft = Number(slider.children('li').eq(1).css('margin-left').replace('px', ''));

		index = (following > 4 ) ? index + 3 : index + following - 2;
		//calculate the translate value of the slider container
		translate = index * (width + marginLeft) + 'px';

		slider.addClass('next');
		setTranslateValue(slider, translate);
		slider.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			updateSlider('next', actual, slider, following);
		});

		if( $('.no-csstransitions').length > 0 ) updateSlider('next', actual, slider, following);
	}

	function prevSides(slider) {
		var actual = slider.children('.previous'),
			index = actual.index(),
			width = actual.width(),
			marginLeft = Number(slider.children('li').eq(1).css('margin-left').replace('px', ''));

		translate = index * (width + marginLeft) + 'px';

		slider.addClass('prev');
		setTranslateValue(slider, translate);
		slider.one('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend', function(){
			updateSlider('prev', actual, slider);
		});

		if( $('.no-csstransitions').length > 0 ) updateSlider('prev', actual, slider);
	}

	function updateSlider(direction, actual, slider, numerFollowing) {
		if( direction == 'next' ) {
			
			slider.removeClass('next').find('.previous').removeClass('previous');
			actual.removeClass('current');
			if( numerFollowing > 4 ) {
				actual.addClass('previous').next('li').next('li').next('li').addClass('current');
			} else if ( numerFollowing == 4 ) {
				actual.next('li').next('li').addClass('current').prev('li').prev('li').addClass('previous');
			} else {
				actual.next('li').addClass('current').end().addClass('previous');
			}
		} else {
			
			slider.removeClass('prev').find('.current').removeClass('current');
			actual.removeClass('previous').addClass('current');
			if(actual.prevAll('li').length > 2 ) {
				actual.prev('li').prev('li').prev('li').addClass('previous');
			} else {
				( !slider.children('li').eq(0).hasClass('current') ) && slider.children('li').eq(0).addClass('previous');
			}
		}
		
		updateNavigation();
	}

	function updateNavigation() {
		//update visibility of next/prev buttons according to the visible slides
		var current = projectsContainer.find('li.current');
		(current.is(':first-child')) ? sliderNav.find('.prev').addClass('inactive') : sliderNav.find('.prev').removeClass('inactive');
		(current.nextAll('li').length < 3 ) ? sliderNav.find('.next').addClass('inactive') : sliderNav.find('.next').removeClass('inactive');
	}

	function setTranslateValue(item, translate) {
		item.css({
		    '-moz-transform': 'translateX(-' + translate + ')',
		    '-webkit-transform': 'translateX(-' + translate + ')',
			'-ms-transform': 'translateX(-' + translate + ')',
			'-o-transform': 'translateX(-' + translate + ')',
			'transform': 'translateX(-' + translate + ')',
		});
	}
});

