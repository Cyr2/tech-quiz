import { useAuth } from "../stores/auth.js";

/* fonction pour fetch les réponses d'une question */
export async function fetchReponses(question_id: string) {
    const token  = useAuth();
    const response = await fetch(`http://127.0.0.1:8000/api/answer/question/${question_id}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization':'Bearer ' + token.getToken()
        }
    });

    const data = await response.json();
        
    return data;
}