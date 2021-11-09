// add showToolTip function to jQuery object to be called by any element wrapped in jQuery object
$.fn.showToolTip = function(config){

  // check if the host element is already positioned. If not set it to relative so tooltip can be positioned relative to host
  if ($(this).css('position') === 'static') {
    $(this).css('position', 'relative');
  }
	console.log(config.position);
  // attach tooltip to the host element as the last child
  $(this).append(`
	<div class="tooltip">
		<div class="tooltip-content">
			<div class="tooltip-header">
				${config.title}
			</div>
			<div class="tooltip-body">
				${config.content}
			</div>
		</div>
		<div class="tooltip-action">
			<button class="tooltip-btn">Okay</button>
		</div>
	</div>
  `);

  // set up click listener on the tooltip OKAY button to animate its disapperance, to remove it from the DOM and also fire the callback provided as an argument
  $('.tooltip-btn').click(function () {
    $('.tooltip').animate({ opacity: 0 }, 330, function(){
      $(this).remove();
      config.onApprove();
    })
  });

  // grab dimensional info about the tooltip, host element and the viewport width and height to calculate in which direction to show the tooltip
  let tooltipInf = $('.tooltip')[0].getBoundingClientRect();
  let parentInf = $(this)[0].getBoundingClientRect();
  let winHeight = $(window).height();
  let winWidth = $(window).width();
  if(config.position=="right"){
	  $('.tooltip')
      .css({ top: '50%', marginTop: -(tooltipInf.height / 2) + 'px', left: '100%' })
      .animate({ left: ($(this).outerWidth() + 10) + 'px', opacity: 1 });
  } else if(config.position=="left"){
	  $('.tooltip')
      .css({ top: '50%', marginTop: -(tooltipInf.height / 2) + 'px', left: -($('.tooltip').outerWidth()) + 'px' })
      .animate({ left: -($('.tooltip').outerWidth() + 10) + 'px', opacity: 1 });
  } else if(config.position=="top"){
	  $('.tooltip')
      .css({ left: '50%', marginLeft: -($('.tooltip').outerWidth() / 2) + 'px', top: -(tooltipInf.height) + 'px' })
      .animate({ top: -(tooltipInf.height + 10) + 'px', opacity: 1 });
  } else if(config.position=="bottom"){
	  $('.tooltip')
      .css({ left: '50%', marginLeft: -($('.tooltip').outerWidth() / 2) + 'px', top: '100%' })
      .animate({ top: ($(this).outerHeight() + 10) + 'px', opacity: 1 });
  }	else {
	  $('.tooltip')
      .css({ left: '50%', top: '50%', marginLeft: -($('.tooltip').outerWidth() / 2) + 'px', marginTop: -(tooltipInf.height / 2) + 'px'})
      .animate({opacity: 1 });
  }
/*
  // determine if there is enough space to the TOP of element to place tooltip at the TOP
  if (parentInf.top > tooltipInf.height + 10) {
    $('.tooltip')
      .css({ left: '50%', marginLeft: -($('.tooltip').outerWidth() / 2) + 'px', top: -(tooltipInf.height) + 'px' })
      .animate({ top: -(tooltipInf.height + 10) + 'px', opacity: 1 });

  // determine if there is enough space to the BOTTOM of element to place tooltip at the BOTTOM
  } else if (winHeight - parentInf.bottom > tooltipInf.height + 10) {
    $('.tooltip')
      .css({ left: '50%', marginLeft: -($('.tooltip').outerWidth() / 2) + 'px', top: '100%' })
      .animate({ top: ($(this).outerHeight() + 10) + 'px', opacity: 1 });

  // determine if there is enough space to the LEFT of element to place tooltip to the LEFT
  } else if (parentInf.left > tooltipInf.width + 10) { // left
    $('.tooltip')
      .css({ top: '50%', marginTop: -(tooltipInf.height / 2) + 'px', left: -($('.tooltip').outerWidth()) + 'px' })
      .animate({ left: -($('.tooltip').outerWidth() + 10) + 'px', opacity: 1 });

  // determine if there is enough space to the RIGHT of element to place tooltip to the RIGHT
  } else if (winWidth - parentInf.right > tooltipInf.width + 10) { // right
    $('.tooltip')
      .css({ top: '50%', marginTop: -(tooltipInf.height / 2) + 'px', left: '100%' })
      .animate({ left: ($(this).outerWidth() + 10) + 'px', opacity: 1 });

  // if TOP, RIGHT, BOTTOM, LEFT doesnt have enough space to show tooltip, then popup tooltip directly atop and in the center of element
  } else {
    $('.tooltip')
      .css({ left: '50%', top: '50%', marginLeft: -($('.tooltip').outerWidth() / 2) + 'px', marginTop: -(tooltipInf.height / 2) + 'px'})
      .animate({opacity: 1 });
  } */
}
