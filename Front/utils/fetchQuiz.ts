export async function fetchQuiz() {
    const response = await fetch(`/quiz.json`);
        
    if (!response.ok) {
        throw new Error(`Erreur HTTP: ${response.status}`);
    }

    const data = await response.json();
    const quiz = data.quiz;
        
    return quiz;
}