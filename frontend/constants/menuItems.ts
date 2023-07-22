import {Url} from '@/constants/url';
import { useRouter } from "nuxt/app";
import {Icons} from '@/constants/icons';

const router = useRouter();

export const MenuItems = [
    {
      text: "ホーム",
      icon: "mdiAccount",
      func: () => router.push(Url.TOP),
    },
    {
      text: "マイページ",
      icon: "mdiAccount",
      func: () => router.push(Url.MEMBER),
    },
    {
      text: "サイクリング募集",
      icon: "mdiAccount",
      func: () => router.push(Url.RECRUIT),
    },
    {
      text: "サイクリング情報",
      icon: "mdiAccount",
      func: () => router.push(Url.INFO),
    },
    {
      text: "みんなの愛車",
      icon: "mdiAccount",
      func: () => router.push(Url.INTRODUCTION),
    },
    {
      text: "ルート検索",
      icon: "mdiAccount",
      func: () => router.push(Url.SEARCH),
    },
    {
      text: "新規登録",
      icon: "mdiAccount",
      func: () => router.push(Url.SIGNUP),
    },
    {
      text: "ログイン",
      icon: "mdiAccount",
      func: () => router.push(Url.LOGIN),
    },
  ]
