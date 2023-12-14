export interface Props {
  accept?: string;
  days: string;
  detailDays: string;
  areas: string[];
  average: string;
  buttonTitle?: string;
  buttonIcon?: string;
  body: string;
  classes: string;
  color?: string | null;
  confirm: boolean;
  detailActivities: string;
  detailAreas: string;
  disabled?: boolean;
  fromAge: string;
  headerImgPath?: string;
  thumbnailPath?: string;
  height?: number;
  icon: string;
  id: string;
  introduction: string;
  isSelecting: boolean;
  items: string[];
  label: string;
  member: string;
  memberCount: number;
  name?: string | undefined | null;
  padding?: string;
  page?: string | null;
  path: string;
  pathHeader: string;
  pathThumbnail: string;
  placeholder?: string;
  prependIcon?: string;
  profiles: string;
  provider: string;
  size?: number;
  rides: string[];
  teamName: string;
  teamUrl: string;
  text: string;
  to?: string | null;
  toAge: string;
  toggle: boolean;
  type?: string;
  userId: number;
  val?: boolean | string | number | null;
  variant: string;
  // variant: NonNullable<"elevated" | "flat" | "text" | "tonal" | "outlined" | "plain"> | undefined;
}

export interface Emits {
  (e: "emitClick", value: HTMLElement): void;
  (
    e: "emitInput",
    value: File | HTMLInputElement | { val: File; target: String } | string
  ): void;
  (e: "emitAgeAverage", value: String): void;
  (e: "emitFromAge", value: String): void;
  (e: "emitToAge", value: String): void;
  (e: "emitRides", value: HTMLInputElement): void;
  (e: "emitRides", value: Array<string>): void;
  (e: "emitAreas", value: Array<string>): void;
  (e: "emitDetailActivities", value: String): void;
  (e: "emitDetailAreas", value: String): void;
  (e: "emitActiveDateDetail", value: String): void;
  (e: "emitActiveDate", value: String): void;
  (e: "emitTeamUrl", value: String): void;
}

export interface Team {
  days: Array<string>;
  detail_day: string;
  areas: Array<string>;
  header_img_path: string;
  id: number;
  introduction: string;
  profiles: string;
  profiles_count: number;
  rides: Array<string>;
  team_name: string;
  thumbnail_path: string;
}
