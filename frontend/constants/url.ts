const getFrontUrl = (path: string): string => {
  return ['', path].join('')
}


export const Url = {
  /**----------------------**/
  /**-------LoggedIn-------**/
  /**----------------------**/
  /** マイページ */
  MYPAGE: getFrontUrl('/auth'),
  /** マイページ（メンバー募集）（ */
  AUTHRECRUIT: getFrontUrl('/auth/recruit'),
  /** マイページ（プロフィール）（ */
  PROFILE: getFrontUrl('/auth/profile'),
  /** マイページ（メッセージ）（ */
  MESSAGES: getFrontUrl('/auth/messages'),
  /** マイページ（チーム）（ */
  AUTHTEAMS: getFrontUrl('/auth/teams'),
  /** マイページ（マイチーム）（ */
  MYTEAM: getFrontUrl('/auth/teams/myteam'),
  /** マイページ（所属チーム一覧）（ */
  AFFILIATION: getFrontUrl('/auth/teams/affiliation'),
  /** マイページ（愛車紹介）（ */
  MYBICYCLE: getFrontUrl('/auth/mybicycle'),

  /**----------------------**/
  /**------BeforeLogin-----**/
  /**----------------------**/
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
  TEAMS: getFrontUrl('/teams'),
  /** サイクリング情報 */
  INFO: getFrontUrl('/info'),
  /** みんなの愛車 */
  BICYCLES: getFrontUrl('/bicycles'),
  /** ルート検索 */
  SEARCH: getFrontUrl('/search'),
  /** パスワードリセット **/
  RESETPASSWORD: getFrontUrl('/passwords/forgotpassword'),
  /** パスワードリセット **/
  CYCLINGINFO: getFrontUrl('/cyclinginfo'),

}
