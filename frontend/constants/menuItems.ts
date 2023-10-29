import {Url} from './url';
import {Icons} from './icons';
import { useAuthStore } from '~/stores/useAuthStore';
import {useRouter} from '#imports';

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
    // {
    //   text: "サイクリング情報",
    //   icon: Icons.INFORMATION,
    //   func: () => router.push(Url.CYCLINGINFO),
    // },
    // {
    //   text: "みんなの愛車",
    //   icon: Icons.BICYCLE,
    //   func: () => router.push(Url.BICYCLES),
    // },
    // {
    //   text: "ルート検索",
    //   icon: Icons.MAP,
    //   func: () => router.push(Url.SEARCH),
    // },
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
    {
      text: "ログアウト",
      icon: Icons.LOGOUT,
      func: () => {
        useAuthStore().logout();
        return false;
      }
    },
    {
      text: "各種設定",
      icon: Icons.LOGOUT,
      func: () => {
        useAuthStore().logout();
        return false;
      }
    },
  ]

export const AuthMenus = [
    {
      text: "チーム",
      icon: Icons.HOME,
      url:Url.AUTHTEAMS,
    },
    {
      text: "メンバー募集",
      icon: Icons.HOME,
      url:Url.AUTHRECRUIT,
    },
    {
      text: "プロフィール",
      icon: Icons.HOME,
      url:Url.AUTHPROFILE,
    },
    {
      text: "メッセージ",
      icon: Icons.HOME,
      url:Url.MESSAGES,
    },
  ]

export const AuthTeamMenus = [
    {
      text: "マイチーム",
      icon: Icons.HOME,
      url:Url.MYTEAM,
    },
    {
      text: "所属チーム一覧",
      icon: Icons.HOME,
      url:Url.AFFILIATION,
    },
  ]
