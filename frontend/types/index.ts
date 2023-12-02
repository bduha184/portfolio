
export interface Props {
  accept?: string;
  activeDate:string;
  activeDateDetail:string;
  areas:string[];
  average:string;
  buttonTitle?:string;
  buttonIcon?:string;
  body:string;
  classes:string;
  color: string;
  confirm:boolean;
  detailActivities:string;
  detailAreas:string;
  disabled?: boolean;
  fromAge:string;
  headerImgPath?:string;
  thumbnailPath?:string;
  height: number;
  icon:string;
  id:string;
  introduction:string;
  isSelecting: boolean;
  items:string[];
  label:string;
  member: string;
  memberCount: number;
  name?:string | undefined | null;
  padding?:string;
  page?:string | null;
  path:string;
  pathHeader:string;
  pathThumbnail:string;
  placeholder?: string;
  prependIcon?: string;
  profiles:string;
  provider:string;
  size?:number;
  tags:string[];
  teamName:string;
  teamUrl:string;
  text:string;
  to?: string;
  toAge: string;
  toggle:boolean;
  type?: string;
  userId:number;
  val?: boolean | string | number | null;
  variant: NonNullable<"elevated" | "flat" | "text" | "tonal" | "outlined" | "plain"> | undefined;
}

export interface Emits {
  (e:"emitClick",value:HTMLElement):void;
  (e:"emitInput", value: File | HTMLInputElement | {val:File,target:String} | string): void;
  (e:"emitTags", value: HTMLInputElement): void;
  (e:"emitAgeAverage", value: String): void;
  (e:"emitFromAge", value: String): void;
  (e:"emitToAge", value: String): void;
  (e:"emitTags", value: Array<string>): void;
  (e:"emitAreas", value: Array<string>): void;
  (e:"emitDetailActivities", value: String): void;
  (e:"emitDetailAreas", value: String): void;
  (e:"emitActiveDateDetail", value: String): void;
  (e:"emitActiveDate", value: String): void;
  (e:"emitTeamUrl", value: String): void;
}

export interface Team {
  id:number;
  activeDatetime:string;
  areas:Array<string>;
  headerImgPath:string;
  thumbnailPath:string;
  teamName:string;
  profilesCount:number;
  profiles:string;
  introduction:string;
  tags:Array<string>;
}
