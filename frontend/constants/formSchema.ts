import {object,string} from "yup";

export const formSchema = {
  EMAIL:object({
    name:
    string().
    trim().
    required('必須項目です').
    min(3,'3文字以上で入力してください').
    max(20,'20文字以内で入力してください'),
  }),
  NAME:object({
    name:
    string().
    trim().
    required('必須項目です').
    min(3,'3文字以上で入力してください').
    max(20,'20文字以内で入力してください'),
  }),
}
