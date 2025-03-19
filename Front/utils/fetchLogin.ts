export async function fetchLogin(email: string, password: string) {
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        });
        
        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }

        const data = await response.json();

        return data;
    } catch (error) {
        console.error('Erreur lors de la connexion:', error);
        throw error;
    }
}