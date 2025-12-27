document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the form from refreshing the page
    
    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const message = document.getElementById('message').value;
  
    // Simulate form submission (could be replaced with an API call)
    setTimeout(() => {
      const response = document.getElementById('formResponse');
      response.classList.remove('hidden');
      response.textContent = `Thank you, ${name}! Your message has been sent.`;
      document.getElementById('contactForm').reset();
    }, 500);
  });
  