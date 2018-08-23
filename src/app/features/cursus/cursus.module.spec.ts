import { CursusModule } from './cursus.module';

describe('CursusModule', () => {
  let cursusModule: CursusModule;

  beforeEach(() => {
    cursusModule = new CursusModule();
  });

  it('should create an instance', () => {
    expect(cursusModule).toBeTruthy();
  });
});
