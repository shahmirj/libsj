
#Define some variables
RELEASEPREFIX := release
RELEASETARGET := $(RELEASEPREFIX)-$(shell svn info | grep Revision | sed 's/Revision: //')

all: setup

setup:
	@if [ ! -d bin ]; then mkdir bin; fi
	@cd bin; if [ ! -L bin/php ]; then ln -snfv ../php; fi
	@cd bin; if [ ! -L bin/scripts ]; then ln -snfv ../scripts; fi
	@cd bin; if [ ! -L bin/js ]; then ln -snfv ../js; fi
	@cd bin; if [ ! -L bin/java ]; then ln -snfv ../java; fi

release: setup
	
	@if [ -d $(RELEASETARGET) ]; then rm -Rv $(RELEASETARGET)/; fi
	@mkdir -v $(RELEASETARGET)
	@rsync -aLr bin/* $(RELEASETARGET)/.

clean:
	@rm -Rv bin/*
	@rm -Rv bin
	
