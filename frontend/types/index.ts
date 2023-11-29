
export interface Props {
  accept?: string;
  active_datetime:string;
  areas:string[];
  average:string;
  body:string;
  classes:string;
  color: string;
  confirm:boolean;
  detail_activities:string;
  detail_areas:string;
  disabled?: boolean;
  from_age:string;
  height: number;
  icon:string;
  isSelecting: boolean;
  label:string;
  member_count: number;
  name?:string;
  padding?:string;
  page?:string | null;
  path:string;
  path_header:string;
  path_thumbnail:string;
  placeholder?: string;
  prependIcon?: string;
  provider:string;
  size?:number;
  tags:string[];
  team_url:string;
  text:string;
  to?: string;
  to_age: string;
  toggle:boolean;
  type?: string;
  val?: boolean | string | number | null;
  variant: NonNullable<"elevated" | "flat" | "text" | "tonal" | "outlined" | "plain"> | undefined;
}

export interface Emits {
  (e:"emitClick",value:HTMLElement):void;
  (e:"emitInput", value: File | HTMLInputElement | {val:File,target:String}): void;
  (e:"emitTags", value: HTMLInputElement): void;
  (e:"emitAgeAverage", value: String): void;
  (e:"emitFromAge", value: String): void;
  (e:"emitToAge", value: String): void;
  (e:"emitTags", value: Array<string>): void;
  (e:"emitAreas", value: Array<string>): void;
  (e:"emitDetailActivities", value: String): void;
  (e:"emitDetailAreas", value: String): void;
  (e:"emitActiveDatetime", value: String): void;
  (e:"emitTeamUrl", value: String): void;
}

export interface Team {
  id:number;
  active_datetime:string;
  areas:Array<string>;
  header_img_path:string;
  thumbnail_path:string;
  team_name:string;
  profiles_count:number;
  profiles:string;
  introduction:string;
  tags:Array<string>;
}
