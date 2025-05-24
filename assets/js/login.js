const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const showButton = document.getElementById('btn');
        const container = document.getElementById('container2');
        const showBtn = document.getElementById('btn2');
        const showBtn3 = document.getElementById('btn3');
        const showBtn4 = document.getElementById('btn4');
        signUpButton.addEventListener('click', () => {
        container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });

        showButton.addEventListener('click', () => {
        container.classList.toggle('show');
        });
        showBtn.addEventListener('click', () => {
        container.classList.toggle('show');
        });
        showBtn3.addEventListener('click', () => {
        container.classList.toggle('show');
        });
        showBtn4.addEventListener('click', () => {
        container.classList.toggle('show');
        });

document.getElementById("toggle-content").addEventListener("click", function(event) {
  event.preventDefault(); // Prevent the default link behavior
  var fullContent = document.getElementById("full-content");
  var shortContent = document.getElementById("short-content");
  
  if (fullContent.style.display === "none") {
    fullContent.style.display = "block";
    shortContent.style.display = "block";
    this.innerHTML = '<span>Read Less</span><i class="bi bi-arrow-up"></i>';
  } else {
    fullContent.style.display = "none";
    shortContent.style.display = "block";
    this.innerHTML = '<span>Read More</span><i class="bi bi-arrow-right"></i>';
  }
});
function showPopup(message) {
            console.log("showPopup called with message:", message); // Debugging line
            var popup = document.getElementById('popup');
            if (popup) {
                popup.innerText = message;
                popup.classList.add('active');
                setTimeout(closePopup, 2000); // Close popup after 2 seconds
            } else {
                console.error("Popup element not found");
            }
        }

        function closePopup() {
            var popup = document.getElementById('popup');
            if (popup) {
                popup.classList.remove('active');
            }
        }
document.getElementById('showFormBtn').addEventListener('click', function(event) {
    event.preventDefault(); // Prevents the default action of the link
    const container = document.getElementById('container3');
    if (container.style.display === 'none') {
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
    }
});
