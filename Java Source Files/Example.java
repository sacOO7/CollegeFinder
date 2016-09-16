/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package example;

import com.itextpdf.text.pdf.PdfDictionary;
import com.itextpdf.text.pdf.PdfObject;
import com.itextpdf.text.pdf.PdfReader;
import com.itextpdf.text.pdf.parser.PdfTextExtractor;
import com.mongodb.BasicDBObject;
import com.mongodb.DB;
import com.mongodb.DBCollection;
import com.mongodb.MongoClient;
import com.mongodb.client.MongoCollection;
import com.mongodb.client.MongoDatabase;

import java.io.*;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

import com.sun.xml.internal.ws.util.StringUtils;
import org.bson.Document;
import sun.rmi.runtime.Log;
import sun.util.resources.CalendarData_sr;

/**
 *
 * @author sachin
 */

public class Example {


    /**
     * @param args the command line arguments
     */

    List<CollegeDataObject> object = new ArrayList<>();
    String PrevCollege = "";
    CollegeDataObject singlecollegedata;
    CastDataObject castDataObject;
    String PrevBranch = "";

    public CastDataObject getCastDataObject() {
        return castDataObject;
    }

    public void setCastDataObject(CastDataObject castDataObject) {
        this.castDataObject = castDataObject;
    }

    public String getPrevBranch() {
        return PrevBranch;
    }

    public void setPrevBranch(String prevBranch) {
        PrevBranch = prevBranch;
    }


    public CollegeDataObject getSinglecollegedata() {
        return singlecollegedata;
    }

    public void setSinglecollegedata(CollegeDataObject singlecollegedata) {
        this.singlecollegedata = singlecollegedata;
    }

    public List<CollegeDataObject> getObject() {
        return object;
    }

    public void addObject(CollegeDataObject object) {
        this.object.add(object);
    }

    public String getPrevCollege() {
        return PrevCollege;
    }

    public void setPrevCollege(String prevCollege) {
        PrevCollege = prevCollege;
    }

    public static void main(String[] args) throws IOException {

        String line, prev = "";

        Example example = new Example();
        String[] exclusions = {"100550310 - Food Technology", "100551710 - Oil and Paints Technology", "100552410 - Paper and Pulp Technology",
                "100552710 - Petro Chemical Engineering"};
        //  File file=new File("/home/sachin/Downloads/2014ENGG_Cutoff_CAP1.txt");
        PdfReader reader = new PdfReader("/home/sachin/Downloads/2014ENGG_Cutoff_CAP2.pdf");
        //  System.out.println("This PDF has " + reader.getNumberOfPages() + " pages.");

        for (int i = 1; i < reader.getNumberOfPages(); i += 1) {
            String page = PdfTextExtractor.getTextFromPage(reader, i);
            InputStream is = new ByteArrayInputStream(page.getBytes());
            // read it with BufferedReader
            BufferedReader br = new BufferedReader(new InputStreamReader(is));
            int count = 1;
            while ((line = br.readLine()) != null) {
                if (count == 7) {

                 //  System.out.println("substring is"+line.substring(6));
                 //   System.out.println("Prev college is"+example.getPrevCollege());
                    if (!line.substring(6).trim().equals(example.getPrevCollege())) {
                        // System.out.println("College Name" + line);
                        if (example.getPrevCollege() != "") {
                            example.addObject(example.getSinglecollegedata());
                        }
                        example.setPrevCollege(line.substring(6).trim());
                        CollegeDataObject object = new CollegeDataObject();
                        object.setCollegeName(line.substring(6).trim());
                        int temp;
                        if ((temp=line.substring(6).trim().split(",").length)>1) {
                            object.setCity(line.substring(6).trim().split(",")[temp - 1].trim());
                            object.setCollegeName(line.substring(6).trim().replace(line.substring(6).trim().split(",")[temp - 1].trim(),"").trim().replace(",","").trim());
                        }
                        example.setSinglecollegedata(object);
                    } else {

                    }
                }
                if (count == 8) {

                        // System.out.print("Branch name" + line);
                    if (!line.contains("NT1") && !line.contains("NT2") && !line.contains("NT3") && !line.contains("OBC")) {
                        if (example.getPrevBranch() != "") {
                            example.getSinglecollegedata().AddObject(example.getCastDataObject());
                            CastDataObject object = new CastDataObject();
                            object.setBranchName(line.substring(11).trim());
                            example.setPrevBranch(line.substring(11).trim());
                            example.setCastDataObject(object);
                        } else {
                            CastDataObject object = new CastDataObject();
                            object.setBranchName(line.substring(11).trim());
                            example.setCastDataObject(object);
                            example.setPrevBranch(line.substring(11).trim());
                        }
                    }
                    else
                    {
                        break;
                    }
                }
                if (count == 10) {
                    // System.out.println("open rank"+line);

                    if (line.contains("GOPENO") || line.contains("GOPENH")) {
//                        if (isNumeric(line)) {
//                            if (line.trim().equals(null))
//                                line = "0";
                        if (line.split(" ").length>1) {
                            if (isNumeric(line.split(" ")[1].trim()))
                            example.getCastDataObject().setOpen(line.split(" ")[1].trim());
                        }else{
                            line = br.readLine();
                            if (line.split(" ").length>1) {
                                if (isNumeric(line.split(" ")[1].trim()))
                                example.getCastDataObject().setOpen(line.split(" ")[1].trim());
                            }else {
                                if (isNumeric(line.trim()))
                                example.getCastDataObject().setOpen(line.trim());
                            }
                        }
                       // }
                    }

                    while ((line = br.readLine()) != null) {
                        if (line.contains("GSCO") || line.contains("GSCH")) {
//                            if (isNumeric(line)) {
//                                if (line.trim().equals(null))
//                                    line = "0";
                            if (line.split(" ").length>1) {
                                if (isNumeric(line.split(" ")[1].trim()))
                                example.getCastDataObject().setSc(line.split(" ")[1].trim());
                            }
                            else{
                                line = br.readLine();
                                if (line.split(" ").length>1) {
                                    if (isNumeric(line.split(" ")[1].trim()))
                                    example.getCastDataObject().setSc(line.split(" ")[1].trim());
                                }else {
                                    if (isNumeric(line.trim()))
                                    example.getCastDataObject().setSc(line.trim());
                                }
                            }

                            //}
                        }
                        if (line.contains("GSTO") || line.contains("GSTH")) {
//                            if (isNumeric(line)) {
//                                if (line.trim().equals(null))
//                                    line = "0";
                            if (line.split(" ").length>1) {
                                if (isNumeric(line.split(" ")[1].trim()))
                                example.getCastDataObject().setSt(line.split(" ")[1].trim());
                            }else{
                                line = br.readLine();
                                if (line.split(" ").length>1) {
                                    if (isNumeric(line.split(" ")[1].trim()))
                                    example.getCastDataObject().setSt(line.split(" ")[1].trim());
                                }else {
                                    if (isNumeric(line.trim()))
                                    example.getCastDataObject().setSt(line.trim());
                                }
                            }
                            //}
                        }
                        if (line.contains("GVJO") || line.contains("GVJH")) {
//                            if (isNumeric(line)) {
//                                if (line.trim().equals(null))
//                                    line = "0";

                            if (line.split(" ").length>1) {
                                if (isNumeric(line.split(" ")[1].trim()))
                                example.getCastDataObject().setVj(line.split(" ")[1].trim());
                            }
                            else {
                                line = br.readLine();
                                if (line.split(" ").length>1) {
                                    if (isNumeric(line.split(" ")[1].trim()))
                                    example.getCastDataObject().setVj(line.split(" ")[1].trim());
                                }
                                else {
                                    if (isNumeric(line.trim()))
                                    example.getCastDataObject().setVj(line.trim());
                                }
                            }
                            //System.out.println("Line is"+line.trim());

                          //  }
                        }
                        if (line.contains("GNT1O" )|| line.contains("GNT1H")) {
//                            if (isNumeric(line)) {
//                                if (line.trim().equals(null))
//                                    line = "0";
                            if (line.split(" ").length>1) {
                                if (isNumeric(line.split(" ")[1].trim()))
                                example.getCastDataObject().setNt1(line.split(" ")[1].trim());
                            }
                            else {
                                line = br.readLine();
                                if (line.split(" ").length>1) {
                                    if (isNumeric(line.split(" ")[1].trim()))
                                    example.getCastDataObject().setNt1(line.split(" ")[1].trim());
                                }
                                else {

                                    if (isNumeric(line.trim()))
                                    example.getCastDataObject().setNt1(line.trim());
                                }
                            }
//                            }

                        }
                        if (line.contains("GNT2O") || line.contains("GNT2H")) {
//                            if (isNumeric(line)) {
//                                if (line.trim().equals(null))
//                                    line = "0";

                            if (line.split(" ").length>1) {
                                if (isNumeric(line.split(" ")[1].trim()))
                                example.getCastDataObject().setNt2(line.split(" ")[1].trim());
                            }
                            else {
                                line = br.readLine();
                                if (line.split(" ").length>1) {
                                    if (isNumeric(line.split(" ")[1].trim()))
                                    example.getCastDataObject().setNt2(line.split(" ")[1].trim());
                                }
                                else {
                                    if (isNumeric(line.trim()))
                                    example.getCastDataObject().setNt2(line.trim());
                                }
                            }
//                            }

                        }
                        if (line.contains("GNT3O") || line.contains("GNT3H")) {
//                            if (isNumeric(line)) {
//                                if (line.trim().equals(null))
//                                    line = "0";
                            if (line.split(" ").length>1) {
                                if (isNumeric(line.split(" ")[1].trim()))
                                example.getCastDataObject().setNt3(line.split(" ")[1].trim());
                            }
                            else {
                                line = br.readLine();
                                if (line.split(" ").length>1) {
                                    if (isNumeric(line.split(" ")[1].trim()))
                                    example.getCastDataObject().setNt3(line.split(" ")[1].trim());
                                }
                                else {
                                    if (isNumeric(line.trim()))
                                    example.getCastDataObject().setNt3(line.trim());
                                }
                            }
                         //   }

                        }
                        if (line.contains("GOBCO") || line.contains("GOBCH")) {
//                            if (isNumeric(line)) {
//                                if (line.trim().equals(null))
//                                    line = "0";
                            if (line.split(" ").length>1) {
                                if (isNumeric(line.split(" ")[1].trim()))
                                example.getCastDataObject().setOBC(line.split(" ")[1].trim());
                            }
                            else {
                                line = br.readLine();
                                if (line.split(" ").length>1)
                                {
                                    if (isNumeric(line.split(" ")[1].trim()))
                                    example.getCastDataObject().setOBC(line.split(" ")[1].trim());
                                }
                                else {
                                    if (isNumeric(line.trim()))
                                    example.getCastDataObject().setOBC(line.trim());
                                }
                            }
                        //    }
                        }

                    }


                }
//                if (count == 14) {
//                    //   System.out.println("sc rank is"+line);
//                    if (isNumeric(line)) {
//                        if (line.trim().equals(null))
//                            line = "0";
//                        example.getCastDataObject().setSc(line.trim());
//                    }
//
//
//                }
//                if (count == 17) {
//                    // System.out.println("st rank is"+line);
//                    if (isNumeric(line)) {
//                        if (line.trim().equals(null))
//                            line = "0";
//                        example.getCastDataObject().setSt(line.trim());
//
//                    }
//                }
//                if (count == 20) {
//                    if (isNumeric(line)) {
//                        if (line.trim().equals(null))
//                            line = "0";
//                        if (prev.equals("GVJO")) {
//                            //   System.out.println("VJ rank is"+line);
//                            example.getCastDataObject().setVj(line.trim());
//                            line = br.readLine();
//                            line = br.readLine();
//                            line = br.readLine();
//                            count += 3;
//                            //   System.out.println("NT1 rank is"+line);
//                            example.getCastDataObject().setNt1(line.trim());
//
//                        } else {
//                            //   System.out.println("NT1 rank is" + line);
//                            example.getCastDataObject().setNt1(line.trim());
//                            count += 3;
//                        }
//                    }
//
//                }
//            if (count==23)
//            {
//                System.out.println("NT1 rank is"+line);
//            }
//                if (count == 26) {
//
//                    if (isNumeric(line)) {
//                        //  System.out.println("NT2 rank is"+line);
//                        if (line.trim().equals(null))
//                            line="0";
//                        example.getCastDataObject().setNt2(line.trim());
//                    }
//                }
//                if (count == 29) {
//
//                        if (prev.equals("GNT3O")) {
//                            //   System.out.println("NT3 rank is" + line);
//                            if (isNumeric(line)) {
//                                if (line.trim().equals(null))
//                                    line="0";
//                                example.getCastDataObject().setNt3(line.trim());
//                                line = br.readLine();
//                                line = br.readLine();
//                                line = br.readLine();
//                                //    System.out.println("OBC rank is" + line);
//                            }
//                            if (isNumeric(line.split(" ")[0])) {
//                                if (line.split(" ")[0].trim().equals(null))
//                                    line="0";
//                                example.getCastDataObject().setOBC(line.split(" ")[0].trim());
//                            }
//                        } else {
//                            //    System.out.println("OBC rank is" + line);
//                            if (isNumeric(line.split(" ")[0])) {
//                                if (line.split(" ")[0].trim().equals(null))
//                                    line = "0";
//                                example.getCastDataObject().setOBC(line.split(" ")[0].trim());
//                            }
//                        }

                //               }
                count++;
                prev = line;
            }
        }
//                if (count==7)
//                {
//                    if (!line.substring(6).equals(example.getPrevCollege()))
//                    System.out.println("College name is"+line.substring(6));
//                    example.setPrevCollege(line.substring(6));
//
//                }
//                if (count==8)
//                {
//                    if (!line.contains("NT1") && !line.contains("NT2") && !line.contains("NT3") && !line.contains("OBC"))
//                    System.out.println("Branch name is"+line.substring(12));
//                }
//                count++;
//                System.out.println(line);
//            }
//        }

            //example.getSinglecollegedata().AddObject(example.getCastDataObject());
        example.getSinglecollegedata().AddObject(example.getCastDataObject());
            example.addObject(example.getSinglecollegedata());

            //  System.out.println("Size is" + example.getObject().size());

//        for (CollegeDataObject collegeDataObject :example.getObject()) {
//            System.out.println("College Name is " + collegeDataObject.getCollegeName());
//            for (CastDataObject object : collegeDataObject.getObjects()) {
//                System.out.println("Branch name is " + object.getBranchName());
//               // if (isNumeric(object.getOpen()))
//                System.out.println("Open rank is " + object.getOpen());
//               // if (isNumeric(object.getSc()))
//                System.out.println("SC rank is " + object.getSc());
//              //  if (isNumeric(object.getSt()))
//                System.out.println("ST rank is " + object.getSt());
//              //  if (isNumeric(object.getVj()))
//                System.out.println("VJ rank is " + object.getVj());
//              //  if (isNumeric(object.getNt1()))
//                System.out.println("NT1 rank is " + object.getNt1());
//              //  if (isNumeric(object.getNt2()))
//                System.out.println("NT2 rank is " + object.getNt2());
//              //  if (isNumeric(object.getNt3()))
//                System.out.println("NT3 rank is " + object.getNt3());
//              //  if (isNumeric(object.getOBC()))
//                System.out.println("OBC rank is " + object.getOBC());
//            }
//        }


            //BufferedReader reader=new Bufferef ll)
            //{
            //   System.out.println(line);
            //}

               MongoClient mongo1=new MongoClient("localhost");
               MongoDatabase db=mongo1.getDatabase("CollegeFinder");
               MongoCollection<Document> coll=db.getCollection("cap_round2");
        for (CollegeDataObject collegeDataObject :example.getObject()) {
            Document college=new Document();
            college.append("college_name",collegeDataObject.getCollegeName());
            college.append("city",collegeDataObject.getCity());
            System.out.println(collegeDataObject.getCollegeName() + " City "+collegeDataObject.getCity());
            List <Document> branches=new ArrayList<>();
            for (CastDataObject object : collegeDataObject.getObjects()) {
                Document branch=new Document();
                branch.append("branch_name",object.getBranchName());
                branch.append("open",Integer.valueOf(object.getOpen()));
                branch.append("sc",Integer.valueOf(object.getSc()));
                branch.append("st",Integer.valueOf(object.getSt()));
                branch.append("vj",Integer.valueOf(object.getVj()));
                branch.append("nt1",Integer.valueOf(object.getNt1()));
                branch.append("nt2",Integer.valueOf(object.getNt2()));
                branch.append("nt3",Integer.valueOf(object.getNt3()));
                branch.append("obc",Integer.valueOf(object.getOBC()));
                branches.add(branch);
            }
            college.append("Branch",branches);
            coll.insertOne(college);
        }
//                m.append("name","sachin");
//                m.append("year", "first year");
//                m.append("branch", "seond year");
//                List <Document> list=new ArrayList<>();
//                list.add(m);
//                Document s=new Document();
//                s.append("name", "Arjun");
//                s.append("year", "first year");
//                s.append("branch", "seond year");
//                list.add(s);
//                Document parent=new Document();
//                parent.append("embed", list);
//                coll.insertOne(parent);

//              p
//                List <Document> list=new ArrayList<>();
//                for (int i=0;i<10;i++)
//                {
//                    list.add(new Document(m));
//                }
//                coll.insertMany(list);
            //     coll.insertOne(parent);

            // TODO code application logic here

            //              coll.find();

    }

    public static  boolean containsDigit(String s) {
        boolean containsDigit = false;

        if (s != null && !s.isEmpty()) {
            for (char c : s.toCharArray()) {
                if (containsDigit = Character.isDigit(c)) {
                    break;
                }
            }
        }
        return containsDigit;
    }

    public static boolean isNumeric(String str) {

        if (str != null) {
            str=str.trim();
            for (char c : str.toCharArray()) {
                if (!Character.isDigit(c)) return false;
            }
            return true;
        }
        else
        {
            return false;
        }
    }


}
