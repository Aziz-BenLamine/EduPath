document.addEventListener("DOMContentLoaded", () => {
    console.log("Script loaded and DOM ready."); // Debugging confirmation

    const container = document.querySelector('.container');
    const registerBtn = document.querySelector('.register-btn');
    const loginBtn = document.querySelector('.login-btn');

    // Toggle forms
    registerBtn?.addEventListener('click', () => {
        container.classList.add('active');
        console.log('Switched to registration form.');
    });

    loginBtn?.addEventListener('click', () => {
        container.classList.remove('active');
        console.log('Switched to login form.');
    });

    // Handle form submission
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', async function (event) {
            event.preventDefault(); // Prevent the form from submitting traditionally

            console.log("Form submission intercepted."); // Debugging confirmation

            const formData = new FormData(form);
            const formType = form.id === 'loginForm' ? 'login' : 'register';

            // Validation
            const username = formData.get('username')?.trim();
            const email = formData.get('email')?.trim();
            const password = formData.get('password')?.trim();

            if (!username) {
                alert('Username is required.');
                console.log('Validation failed: Username is missing.');
                return;
            }

            if (formType === 'register' && email && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                alert('Please enter a valid email address.');
                console.log('Validation failed: Invalid email.');
                return;
            }

            if (!password || password.length < 6) {
                alert('Password must be at least 6 characters long.');
                console.log('Validation failed: Password is too short.');
                return;
            }

            // Define endpoint based on form type
            const endpoint = formType === 'login' ? '?action=login' : '?action=register';
            console.log(`Submitting to endpoint: ${endpoint}`);

            try {
                // Submit form data
                const response = await fetch(endpoint, {
                    method: 'POST',
                    body: formData,
                });

                const result = await response.text();
                console.log("Server response:", result);

                // Handle server response
                if (response.ok) {
                    alert(result);
                    if (formType === 'login' && result.toLowerCase().includes('login successful')) {
                        const usernameParam = encodeURIComponent(username);
                        window.location.href = `welcomeuser/index.html?username=${usernameParam}`;
                    } else if (formType === 'register') {
                        alert('Registration successful! You can now log in.');
                        container.classList.remove('active'); // Switch to login form
                    }
                } else {
                    console.error("Error response from server:", result);
                    alert(`Error: ${result}`);
                }
            } catch (error) {
                console.error('Error during form submission:', error);
                alert('An error occurred while submitting the form. Please try again.');
            }
        });
    });
});

(function(){
    const fonts = ["cursive","sans-serif","serif","monospace"];
    let captchaValue ="";
    function generateCaptcha(){
        let value= btoa(Math.random()*1000000000);
        value = value.substr(0,5+Math.random()*5);
        captchaValue= value;
    }
    function setCaptcha(){
        let html = captchaValue.split("").map((char)=>{
            const rotate = -20+ Math.trunc(Math.random()*30);
            const font = Math.trunc(Math.random()*fonts.length);
            return `<span
            style="
              transform:rotate(${rotate}deg);
              font-family:${fonts[font]}
            "
            >${char}</span>`;
        }).join("");
        document.querySelector(".register-form .captcha .preview").innerHTML = html;
    }
    function initCaptcha(){
        document.querySelector(".register-form .captcha .captcha-refresh").addEventListener("click",function(){
            generateCaptcha();
            setCaptcha();
        });
        generateCaptcha();
        setCaptcha();
    }
    initCaptcha();

    document.querySelector(".register-form #register-btn").addEventListener("click",function(){
        let inputCaptchaValue = document.querySelector(".register-form .captcha .captcha-form .captcha-input").value;
        if(inputCaptchaValue === captchaValue){
            swal("", "Registration is sucessfull!","sucess");
        }else {
            swal("Invalid captcha");
        }
    })
})();
