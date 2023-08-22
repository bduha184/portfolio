import {object,string} from "yup";

export const formSchema = {
  EMAIL:object({
    name:
    string().
    trim().
    lowercase().
    required('メールアドレスは必須項目です').
    email("正しいメールアドレスを入力してください。")
  }),
  NAME:object({
    name:
    string().
    trim().
    required('必須項目です').
    min(3,'3文字以上で入力してください').
    max(20,'20文字以内で入力してください'),
  }),
  PASSWORD:object({
    password:
    string().
    trim().
    required('必須項目です').
    min(8,'8文字以上で入力してください').
    matches(/^[ -~]+$/, "半角英数記号で入力してください。"),
  }),
}
