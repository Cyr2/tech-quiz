export async function fetchRegister(email: string, password: string) {
        const response = await fetch(`http://127.0.0.1:8000/api/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        });


        const data = await response.json();

        return data;
}