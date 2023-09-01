<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $user_input = $request->input('user_input');
        $response_text = $this->process_input($user_input);
        return response()->json(['response' => $response_text]);
    }

    private function process_input($user_input)
    {
        $user_input = strtolower(trim($user_input));

        $responses = [
            // Existing responses
            'hello' => 'Hello, how can I help you?',
            'hi' => 'Hi, what can I do for you?',
            'bye'=> 'Good bye!',
            'how are you' => 'I am a chatbot, so I don\'t have feelings, but thanks for asking! How can I assist you today?',
            'help' => 'Of course! What do you need assistance with?',
            'jobs' => 'We have various job openings. Please visit our website for more information.',
            'apply' => 'To apply for a job, visit our website and click the "Apply Now" button on the job listing you are interested in.',
            'interview' => 'We typically contact applicants within two weeks of receiving their application to schedule an interview. Please ensure your contact information is up to date.',                 
            'work culture' => 'Our company values a positive and inclusive work culture where everyone can contribute to their fullest potential. We encourage collaboration, innovation, and continuous learning.',
            'job requirements' => 'Job requirements vary depending on the position. Generally, we look for candidates with relevant experience, skills, and educational background. Please refer to the specific job listing for detailed requirements.',
            'job benefits' => 'We offer competitive benefits, including health insurance, retirement plans, paid time off, and more. Details about benefits are discussed during the hiring process.',
            'relocation' => 'Some positions may offer relocation assistance. Please refer to the specific job listing or inquire with our HR department for more information.',
            'job location' => 'We have multiple office locations, and job locations vary depending on the position. Please refer to the specific job listing for details.',
            'remote work' => 'We offer remote work options for certain positions. Please check the job listing for details or inquire with our HR department.',
            'part-time' => 'We offer both full-time and part-time positions. Please visit our website to see the available part-time job openings.',
            'job growth' => 'We encourage professional growth and provide opportunities for career advancement. Employees can access training programs, mentorship, and more to develop their skills.',
            'internships' => 'Yes, we offer internships for students and recent graduates. Check our website for available internship opportunities and their requirements.',
            'hiring process' => 'Our hiring process typically involves a resume review, interviews, and potentially a skills assessment or task. The process may vary depending on the position.'
        ];
        
    foreach ($responses as $pattern => $response) {
        if (strpos($user_input, $pattern) !== false) {
            return $response;
        }
    }

   
    return 'I am sorry, I do not understand.';
    }
}
