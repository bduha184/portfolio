
export interface Props {
  accept?: string | undefined;
  body:string;
  classes:string;
  color: string;
  confirm:boolean;
  disabled?: boolean | undefined;
  height: number;
  icon:string;
  isSelecting: boolean;
  label:string;
  name?:string | undefined;
  padding?:string;
  path:string;
  placeholder?: string | undefined;
  prependIcon?: string;
  provider:string;
  size?:number;
  tags:string[];
  text:string;
  to?: string;
  toggle:boolean;
  type?: string | undefined;
  val?: boolean | string | number | undefined;
  variant: NonNullable<"elevated" | "flat" | "text" | "tonal" | "outlined" | "plain"> | undefined;
}

export interface Emits {
  (e:"emitClick",value:HTMLElement):void;
  (e:"emitInput", value: File | HTMLInputElement): void;
  (e:"emitTags", value: HTMLInputElement): void;
}
