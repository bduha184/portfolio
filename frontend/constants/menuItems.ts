import {Url} from './url';
import {Icons} from './icons';

const router = useRouter();

export const MenuItems = [
    {
      text: "ホーム",
      icon: Icons.HOME,
      func:()=> router.push(Url.TOP),
    },
    {
      text: "マイページ",
      icon: Icons.ACCOUNT,
      func:()=>router.push(Url.MYPAGE),
    },
    {
      text: "サイクリング募集",
      icon: Icons.CYCLING,
      func: () => router.push(Url.TEAMS),
    },
    {
      text: "サイクリング情報",
      icon: Icons.INFORMATION,
      func: () => router.push(Url.CYCLINGINFO),
    },
    {
      text: "みんなの愛車",
      icon: Icons.BICYCLE,
      func: () => router.push(Url.BICYCLES),
    },
    {
      text: "ルート検索",
      icon: Icons.MAP,
      func: () => router.push(Url.SEARCH),
    },
    {
      text: "新規登録",
      icon: Icons.REGISTER,
      func: () => router.push({
        path:Url.SIGNUP,
        query:{
          tab:'register'
        }
      }),
    },
    {
      text: "ログイン",
      icon: Icons.LOGIN,
      func: () => router.push({
        path:Url.SIGNIN,
        query:{
          tab:'login'
        }
      }),
    },
  ]
