const getFrontUrl = (path: string): string => {
  return ['', path].join('')
}

export const Url = {
  /** TOP */
  TOP: getFrontUrl('/'),
  /** ログイン */
  SIGNIN: getFrontUrl('/beforeLogin'),
  /** 会員登録 */
  SIGNUP: getFrontUrl('/signup'),
  /** 会員登録承認 */
  SIGNUP_VERIFICATION: getFrontUrl('/signup/verification'),
  /** 投稿詳細 */
  POSTS: getFrontUrl('/posts'),
  /** マイページ */
  MYPAGE: getFrontUrl('/auth'),
  /** サイクリング募集 */
  RECRUIT: getFrontUrl('/recruit'),
  /** サイクリング情報 */
  INFO: getFrontUrl('/info'),
  /** みんなの愛車 */
  INTRODUCTION: getFrontUrl('/introduction'),
  /** ルート検索 */
  SEARCH: getFrontUrl('/search'),
}
