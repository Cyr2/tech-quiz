import { useAuth } from "../stores/auth.js";

/* fonction pour mettre à jour l'utilisateur */
export const fetchUpdateUser = async (id:string, infos: object) => {
    const token  = useAuth();
    try {
        const response = await fetch(`/api/users/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer '+token.getToken(),
            },
        });

        return await response.json();
    } catch (error) {
        return { error: 'An error occurred while updating the user.' };
    }
};