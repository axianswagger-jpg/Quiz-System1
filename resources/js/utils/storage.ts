import type { Quiz } from "../types/quiz";

type User = { username: string; password: string };

const KEYS = {
  quizzes: "qs_quizzes",
  users: "qs_users",
  currentUser: "qs_currentUser",
};

export const storage = {
  // Quizzes
  getQuizzes(): Quiz[] {
    try {
      return JSON.parse(localStorage.getItem(KEYS.quizzes) || "[]");
    } catch {
      return [];
    }
  },

  saveQuiz(quiz: Quiz) {
    const quizzes = storage.getQuizzes();
    const next = [quiz, ...quizzes.filter((q) => q.id !== quiz.id)];
    localStorage.setItem(KEYS.quizzes, JSON.stringify(next));
  },

  // Users
  getUsers(): User[] {
    try {
      return JSON.parse(localStorage.getItem(KEYS.users) || "[]");
    } catch {
      return [];
    }
  },

  saveUser(user: User) {
    const users = storage.getUsers();
    const next = [user, ...users.filter((u) => u.username !== user.username)];
    localStorage.setItem(KEYS.users, JSON.stringify(next));
  },

  userExists(username: string) {
    return storage.getUsers().some((u) => u.username === username);
  },

  findUser(username: string, password: string) {
    return storage.getUsers().find((u) => u.username === username && u.password === password) || null;
  },

  // Current user
  getCurrentUser(): string | null {
    return localStorage.getItem(KEYS.currentUser);
  },

  setCurrentUser(username: string) {
    localStorage.setItem(KEYS.currentUser, username);
  },

  clearCurrentUser() {
    localStorage.removeItem(KEYS.currentUser);
  },
};
