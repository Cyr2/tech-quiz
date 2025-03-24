import { useAuth } from "../stores/auth.js";

export async function fetchUsers() {
    const { token } = useAuth();

    const response = await fetch(`http://127.0.0.1:8000/api/users`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Token': token.getToken(),
        },
    });

    const data = await response.json();

    return data;

}