function isMobileDevice() {
    const userAgent = navigator.userAgent.toLowerCase();
    const mobileDevices = [
      /android/i,
      /webos/i,
      /iphone/i,
      /ipad/i,
      /ipod/i,
      /blackberry/i,
      /windows phone/i
    ];
  
    return mobileDevices.some(device => userAgent.match(device));
  }
  
  if (isMobileDevice()) {
    // Hide content for mobile devices
    document.querySelector('.container').style.display = 'none';
  
    // Create and append message element
    const messageContainer = document.createElement('div');
    messageContainer.classList.add('message');
  
    const messageHeading = document.createElement('h1');
    messageHeading.textContent = 'This website is not viewable on mobile devices';
  
    const messageText = document.createElement('p');
    messageText.textContent = 'Please view this website on a device with a screen resolution of 768px or higher.';
  
    messageContainer.appendChild(messageHeading);
    messageContainer.appendChild(messageText);
  
    document.querySelector('.mobile-message-container').appendChild(messageContainer);
  } else {
    // Show content for non-mobile devices
    document.querySelector('.container').style.display = 'flex';
  }