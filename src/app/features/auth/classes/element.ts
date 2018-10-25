
export class FileElement {
    id?: string;
    isFolder: boolean;
    name: string;
    parent: string;

    constructor(args) {
        Object.assign(this, args);
    }
  }
