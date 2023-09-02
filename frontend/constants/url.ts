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
  MYPAGE: getFrontUrl('/auth'),
  /** マイページ（メンバー募集）（ */
  AUTHRECRUIT: getFrontUrl('/auth/recruit'),
  /** マイページ（プロフィール）（ */
  PROFILE: getFrontUrl('/auth/profile'),
  /** マイページ（メッセージ）（ */
  MESSAGES: getFrontUrl('/auth/messages'),
  /** マイページ（メッセージ_参加希望）（ */
  REQUESTS: getFrontUrl('/auth/messages/requests'),
  /** マイページ（メッセージ_参加希望）（ */
  QUESTIONS: getFrontUrl('/auth/messages/questions'),
  /** マイページ（チーム）（ */
  TEAMS: getFrontUrl('/auth/teams'),
  /** マイページ（マイチーム）（ */
  MYTEAM: getFrontUrl('/auth/teams/myteam'),
  /** マイページ（所属チーム一覧）（ */
  AFFILIATION: getFrontUrl('/auth/teams/list'),
}
