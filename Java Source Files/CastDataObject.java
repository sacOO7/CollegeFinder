package example;

/**
 * Created by sachin on 21/9/15.
 */
public class CastDataObject {
    private String open;
    private String sc;
    private String st;
    private String vj;
    private String nt3;
    private String nt1;
    private String nt2;
    private String OBC;
    private String BranchName;

    CastDataObject()
    {
        open=sc=st=vj=nt1=nt2=nt3=OBC="0";
    }
    public String getNt3() {
        return nt3;
    }

    public void setNt3(String nt3) {
        this.nt3 = nt3;
    }

    public String getOpen() {
        return open;
    }

    public void setOpen(String open) {
        this.open = open;
    }

    public String getSc() {
        return sc;
    }

    public void setSc(String sc) {
        this.sc = sc;
    }

    public String getSt() {
        return st;
    }

    public void setSt(String st) {
        this.st = st;
    }

    public String getVj() {
        return vj;
    }

    public void setVj(String vj) {
        this.vj = vj;
    }

    public String getNt1() {
        return nt1;
    }

    public void setNt1(String nt1) {
        this.nt1 = nt1;
    }

    public String getNt2() {
        return nt2;
    }

    public void setNt2(String nt2) {
        this.nt2 = nt2;
    }

    public String getOBC() {
        return OBC;
    }

    public void setOBC(String OBC) {
        this.OBC = OBC;
    }

    public String getBranchName() {
        return BranchName;
    }

    public void setBranchName(String branchName) {
        BranchName = branchName;
    }
}
