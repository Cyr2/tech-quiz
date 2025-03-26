import { useAuth } from "../stores/auth";

/* fonction pour créer un historique */
export async function fetchStoreHistory(score: number, quiz_id: number) {

    const token  = useAuth().getToken();
    const userId = useAuth().getUserId();
    const date = new Date().toISOString().split('T')[0];
    const history_id = crypto.randomUUID();

    console.log(history_id, date, score, userId, quiz_id);

    const response = await fetch(`http://127.0.0.1:8000/api/create/history`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization':'Bearer ' + token
        },
        body: JSON.stringify({
            history_id: history_id,
            date: date,
            score: score,
            user_id: userId,
            quiz_id: quiz_id
        })
    });


    const data = await response.json();

    return data;
}