import { useAuth } from "../stores/auth.js";

/* fonction pour fetch toutes les questions d'un quiz */
export async function fetchQuestions(quiz_id: string) {
    const token  = useAuth();
    const response = await fetch(`http://127.0.0.1:8000/api/question/quiz/${quiz_id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization':'Bearer ' + token.getToken()
        }
    });

    const data = await response.json();
        
    return data;
}