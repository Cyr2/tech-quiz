import { useAuth } from '../stores/auth.js';

export async function fetchUpdateQuiz(id: string ,quiz :any, date: string) {
    const token  = useAuth();
    const response = await fetch(`http://127.0.0.1:8000/api/update/quiz/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization':'Bearer ' + token.getToken()
        },
        body: JSON.stringify({
            'title': quiz.title,
            'date': date,
        })

    });

    const data = await response.json();

    quiz.questions.map( async (question : any) => {
        const questionId = question.questionId;
        const createQuestion = await fetch(`http://127.0.0.1:8000/api/update/question/${questionId}`, {
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
            const answerId = answer.answerId;
            const createAnswer = await fetch(`http://127.0.0.1:8000/api/update/answer/${answerId}`, {
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

            console.log(data3);
        }
        );

    });

    return data;

}