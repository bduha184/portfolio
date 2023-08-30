const getFrontUrl = (path: string): string => {
  return ['', path].join('')
}


export const Url = {
  /** TOP */
  TOP: getFrontUrl('/'),
  /** ログイン */
  SIGNIN: getFrontUrl('/beforelogin'),
  /** 会員登録 */
  SIGNUP: getFrontUrl('/beforelogin'),
  /** 会員登録承認 */
  SIGNUP_VERIFICATION: getFrontUrl('/signup/verification'),
  /** 投稿詳細 */
  POSTS: getFrontUrl('/posts'),
  /** サイクリング募集 */
  RECRUIT: getFrontUrl('/recruit/recruitlist'),
  /** サイクリング情報 */
  INFO: getFrontUrl('/info'),
  /** みんなの愛車 */
  INTRODUCTION: getFrontUrl('/introduction'),
  /** ルート検索 */
  SEARCH: getFrontUrl('/search'),
  /** パスワードリセット **/
  RESETPASSWORD: getFrontUrl('/passwords/forgotpassword'),
  /** マイページ */
  MYPAGE: getFrontUrl('/auth/user'),
  /** マイページ（メンバー募集）（ */
  AUTHRECRUIT: getFrontUrl('/auth/user/recruit'),
  /** マイページ（プロフィール）（ */
  PROFILE: getFrontUrl('/auth/user/profile'),
  /** マイページ（メッセージ_参加希望）（ */
  REQUEST: getFrontUrl('/auth/user/messages/requests/list'),
}
