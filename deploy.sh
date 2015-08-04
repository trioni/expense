#!/usr/bin/env bash
# -a : archive mode
# -v : increase verbosity
# -z : compress file data during the transfer
# -n : dry run
rsync -avz --ignore-existing --delete --exclude-from 'deploy_excludes.txt' -e  'ssh' --progress ./ expenses:meck