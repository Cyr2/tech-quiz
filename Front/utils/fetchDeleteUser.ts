import { useAuth } from "../stores/auth.js";

/* fonction pour supprimer l'utilisateur demandé */
export async function fetchDeleteUser(id: string) {
    const token  = useAuth();

    const response = await fetch(`http://127.0.0.1:8000/api/delete/user/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+token.getToken(),
        },
    });

    const data = await response.json();

    

    return data;

}