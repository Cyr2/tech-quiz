import { useAuth } from "../stores/auth.js";

export async function fetchCreateQuiz(quiz : any) {
    const token  = useAuth();
    const date = new Date().toISOString().split('T')[0];

    const createQuiz = await fetch(`http://127.0.0.1:8000/api/create/quiz`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token.getToken()
        },
        body: JSON.stringify({
            title: quiz.title,
            date: date
        })
    });

    const data = await createQuiz.json();

    if(data.error) {
        return data;
    }

    quiz.questions.map( async (question : any) => {

        const createQuestion = await fetch(`http://127.0.0.1:8000/api/create/question`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': 'Bearer ' + token.getToken()
            },
            body: JSON.stringify({
                quiz_id: data.quiz.id,
                label: question.label,
            })
    
        });
    
        const data2 = await createQuestion.json();

        question.answers.map( async (answer : any) => {


            const createAnswer = await fetch(`http://127.0.0.1:8000/api/create/answer`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': 'Bearer ' + token.getToken()

                },
                body: JSON.stringify({
                    question_id: data2.question.id,
                    label: answer.label,
                    is_correct: answer.isCorrect
                })

            });

            const data3 = await createAnswer.json();
        }
        );

    });

    return data;
    
}