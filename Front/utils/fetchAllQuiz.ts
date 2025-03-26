import { useAuth } from "../stores/auth.js";

export async function fetchAllQuiz() {
    const token  = useAuth();
    const response = await fetch(`http://127.0.0.1:8000/api/quiz`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization':'Bearer ' + token.getToken()
        }
    });

    const data = await response.json();
        
    return data;
}