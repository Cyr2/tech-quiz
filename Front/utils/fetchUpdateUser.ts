import { useAuth } from "../stores/auth.js";

/* fonction pour mettre à jour l'utilisateur */
export const fetchUpdateUser = async (id:string, email:string, username:string, password:string, role_id:number) => {
    const token  = useAuth();
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/update/user/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+token.getToken(),
            },
            body: JSON.stringify(
                {
                    email: email,
                    username: username,
                    password: password,
                    role_id: role_id
                }
            ),
        });

        return await response.json();
    } catch (error) {
        return { error: 'An error occurred while updating the user.' };
    }
};