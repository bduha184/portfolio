import {Url} from './url';
import {Icons} from './icons';
import { useAuthStore } from '~/stores/useAuthStore';
import {useRouter} from '#imports';
import {Message} from './flashMessage';
import { useFlashMessageStore } from '~/stores/useFlashMessageStore';

const router = useRouter();
const flashMessage = useFlashMessageStore();

export const MenuItems = [
    {
      text: "ホーム",
      icon: Icons.HOME,
      auth: false,
      func:()=> router.push(Url.TOP),
    },
    {
      text: "マイページ",
      icon: Icons.ACCOUNT,
      auth: true,
      func:()=>router.push(Url.MYPAGE),
    },
    {
      text: "サイクリング募集",
      icon: Icons.CYCLING,
      auth: null,
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
      auth: false,
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
      auth: false,
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
      auth: true,
      func: () => {
        flashMessage.setMessage(Message.LOGOUT);
        useAuthStore().logout();
      }
    },
    // {
    //   text: "各種設定",
    //   icon: Icons.LOGOUT,
    //   auth: true,
    //   func: () => {
    //     useAuthStore().logout();
    //   }
    // },
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
      icon: Icons.ACCOUNT,
      url:Url.AUTHPROFILE,
    },
    {
      text: "メッセージ",
      icon: Icons.MESSAGES,
      url:Url.MESSAGES,
    },
    {
      text: "各種設定",
      icon: Icons.MESSAGES,
      url:Url.SETTING,
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
export const AuthSettingMenus = [
    {
      flg:1,
      text: "英語表記",
      icon: Icons.HOME,
    },
    {
      flg:0,
      text: "退会",
      icon: Icons.HOME,
    },
  ]
