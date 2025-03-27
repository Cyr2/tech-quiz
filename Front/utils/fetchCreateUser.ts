import { useAuth } from "../stores/auth.js";

/* fonction permettant de créer un nouvel utilisateur */
export async function fetchCreateUser(email: string, password: string, user: string, role: number) {
    const token  = useAuth();
    const response = await fetch(`http://127.0.0.1:8000/api/create/user`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer '+token.getToken(),
        },
        body: JSON.stringify({
            email: email,
            password: password,
            username:user,
            role_id: role
        })
    });


    const data = await response.json();

    return data;
}