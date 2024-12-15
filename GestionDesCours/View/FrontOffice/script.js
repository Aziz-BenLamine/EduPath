function filterCourses() {
    const filter = document.getElementById('categoryFilter')?.value;
    const courses = document.querySelectorAll('.course');

    courses.forEach(course => {
        const category = course.getAttribute('data-category');
        if (!filter || filter === 'all' || category === filter) {
            course.style.display = 'block';
        } else {
            course.style.display = 'none';
        }
    });
}

document.addEventListener("DOMContentLoaded", () => {
    // Chatbot open/close functionality
    const chatbotContainer = document.getElementById("chatbot-container");
    const openChatbotButton = document.getElementById("open-chatbot");
    const closeChatbotButton = document.getElementById("close-chatbot");
    const sendChatbotButton = document.getElementById("send-chatbot");
    const chatbotQueryInput = document.getElementById("chatbot-query");

    if (openChatbotButton && chatbotContainer) {
        openChatbotButton.addEventListener("click", () => {
            chatbotContainer.style.display = "flex";
            openChatbotButton.style.display = "none";
        });
    }

    if (closeChatbotButton && chatbotContainer) {
        closeChatbotButton.addEventListener("click", () => {
            chatbotContainer.style.display = "none";
            openChatbotButton.style.display = "block";
        });
    }

    if (sendChatbotButton && chatbotQueryInput) {
        sendChatbotButton.addEventListener("click", async () => {
            const query = chatbotQueryInput.value.trim();
            if (query) {
                displayMessage(query, "user");
                chatbotQueryInput.value = "";
                const response = await getAIResponse(query);
                displayMessage(response, "bot");
            }
        });
    }

    // Initialize course filtering
    const categoryFilter = document.getElementById('categoryFilter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', filterCourses);
    }
});

function displayMessage(message, sender) {
    const messagesDiv = document.getElementById("chatbot-messages");
    if (!messagesDiv) return;

    const messageElement = document.createElement("p");
    messageElement.textContent = sender === "user" ? `Vous: ${message}` : `Bot: ${message}`;
    messagesDiv.appendChild(messageElement);
    messagesDiv.scrollTop = messagesDiv.scrollHeight;
}

async function getAIResponse(query) {
    try {
        const response = await fetch("chatbot-handler.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ query }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const contentType = response.headers.get("content-type");
        if (contentType && contentType.indexOf("application/json") !== -1) {
            const data = await response.json();
            return data.reply;
        } else {
            throw new Error("Invalid JSON response");
        }
    } catch (error) {
        console.error("Error fetching AI response:", error); // Debugging log
        return "Désolé, je ne peux pas répondre en ce moment.";
    }
}
