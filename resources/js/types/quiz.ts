export type Question = {
  id: string;
  text: string;
  options: string[];
  correctAnswerIndex: number;
};

export type Quiz = {
  id: string;
  title: string;
  description: string;
  author: string;
  questions: Question[];
  createdAt: string;
};
