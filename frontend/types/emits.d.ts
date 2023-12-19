

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
