import { useState, useEffect } from "react";
import { RouterProvider } from "react-router-dom";
import { createAppRouter } from "./routes";
import { Quiz, Question } from "./types/quiz";
import { storage } from "./utils/storage";
import { quizQuestions } from "./data/quizData";

export default function App() {
  const [quizzes, setQuizzes] = useState<Quiz[]>([]);
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [username, setUsername] = useState<string | null>(null);

  useEffect(() => {
    const storedQuizzes = storage.getQuizzes();

    if (storedQuizzes.length === 0) {
      const defaultQuiz: Quiz = {
        id: "default-quiz",
        title: "General Knowledge Quiz",
        description: "Test your knowledge with 10 questions covering various topics",
        author: "Quiz Master",
        questions: quizQuestions,
        createdAt: new Date().toISOString(),
      };
      storage.saveQuiz(defaultQuiz);
      setQuizzes([defaultQuiz]);
    } else {
      setQuizzes(storedQuizzes);
    }

    const currentUser = storage.getCurrentUser();
    if (currentUser) {
      setIsLoggedIn(true);
      setUsername(currentUser);
    }
  }, []);

  const handleLogin = (inputUsername: string, inputPassword: string): boolean => {
    const existingUser = storage.findUser(inputUsername, inputPassword);

    if (existingUser) {
      setIsLoggedIn(true);
      setUsername(inputUsername);
      storage.setCurrentUser(inputUsername);
      return true;
    } else {
      if (storage.userExists(inputUsername)) {
        return false;
      }
      storage.saveUser({ username: inputUsername, password: inputPassword });
      setIsLoggedIn(true);
      setUsername(inputUsername);
      storage.setCurrentUser(inputUsername);
      return true;
    }
  };

  const handleLogout = () => {
    setIsLoggedIn(false);
    setUsername(null);
    storage.clearCurrentUser();
  };

  const handleCreateQuiz = (title: string, description: string, questions: Question[]) => {
    const newQuiz: Quiz = {
      id: `quiz-${Date.now()}`,
      title,
      description,
      author: username || "Anonymous",
      questions,
      createdAt: new Date().toISOString(),
    };

    storage.saveQuiz(newQuiz);
    setQuizzes([...quizzes, newQuiz]);
  };

  const router = createAppRouter({
    quizzes,
    isLoggedIn,
    username,
    onLogin: handleLogin,
    onLogout: handleLogout,
    onCreateQuiz: handleCreateQuiz,
  });

  return <RouterProvider router={router} />;
}