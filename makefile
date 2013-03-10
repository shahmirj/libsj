#Set our default behaviour BINARIES
RM=rm -Rfv
MKDIR=mkdir -p
MAKE=make

#Define some variables
#The folder in the name fo release-[revnumber]
REVISIONID=$(shell svn info | grep Revision | awk '{print $$2}')
RELEASEID?=$(REVISIONID)
BUILDID?=unknown-$(REVISIONID)
REVISIONFOLDER=release-$(RELEASEID)

RELEASEPREFIX := release
RELEASETARGET := $(RELEASEPREFIX)-$(shell svn info | grep Revision | sed 's/Revision: //')

all: setup

setup:
	@if [ ! -d bin ]; then mkdir bin; fi
	@cd bin; if [ ! -L bin/php ]; then ln -snfv ../php; fi
	@cd bin; if [ ! -L bin/scripts ]; then ln -snfv ../scripts; fi
	@cd bin; if [ ! -L bin/js ]; then ln -snfv ../js; fi
	@cd bin; if [ ! -L bin/java ]; then ln -snfv ../java; fi

release: release-dir $(REVISIONFOLDER)
	@echo "id: $(BUILDID)" > $(REVISIONFOLDER)/VERSION
	@echo "revision: $(REVISIONID)" >> $(REVISIONFOLDER)/VERSION
	@echo "build-date: $$(date +"%Y-%m-%d %T %z")" >> $(REVISIONFOLDER)/VERSION
	@echo "build-hostname: $$(whoami)@$$(hostname -a)" >> $(REVISIONFOLDER)/VERSION
	@uname -a | awk '{print "build-on: " $$1 " " $$3 " " $$12}' >> $(REVISIONFOLDER)/VERSION
	@svn info | grep -E "^URL:" | awk '{print "svn-url: " $$2}' >> $(REVISIONFOLDER)/VERSION
	@svn info | grep -E "^Last Changed Author:" | awk '{print "svn-lastchange-author: " $$4}' >> $(REVISIONFOLDER)/VERSION
	@svn info | grep -E "^Last Changed Rev:" | awk '{print "svn-lastchange-revision: " $$4}' >> $(REVISIONFOLDER)/VERSION
	@svn info | grep -E "^Last Changed Rev:" | awk '{print "svn-lastchange-date: " $$4 " " $$5 " " $$6}' >> $(REVISIONFOLDER)/VERSION
	@echo "Relase Build Complete in folder $(REVISIONFOLDER)!";

##
# If the revision directory already exist, Throw a message letting the user know of 
# manual intervention. Just a saftey switch, so we dont build on top of an existing folder
#
release-dir:
	@if [ -d $(REVISIONFOLDER) ]; then \
	    echo -n "\n$(REVISIONFOLDER) directory already Exists!"; \
	    echo -n "\nPlease delete this directory manually to continue\n\n"; \
	    exit 1; \
	fi
	$(MKDIR) $(REVISIONFOLDER); 

##
# Rsync all the folders required to REVISIONFOLDER for independant seperation;
# By independant seperation we mean to remove all symlinks from the outside source, and make
# The release folder independant to it self
#
# @required packages - Make sure all the sub packages are build before this step
# 
# @.PHONY release
#
.PHONY: $(REVISIONFOLDER)
$(REVISIONFOLDER):
	rsync -rL php scripts js java $(REVISIONFOLDER)/.

clean:
	$(RM) bin
